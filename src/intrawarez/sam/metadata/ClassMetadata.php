<?php
namespace intrawarez\sam\metadata;

use Doctrine\Common\Annotations\Reader;
use intrawarez\sam\annotations\Group;
use intrawarez\sam\annotations\Action;
use intrawarez\sam\annotations\Middleware;
use function intrawarez\sabertooth\fn\predicates\_instanceOf;
use function intrawarez\sabertooth\fn\repeatables\filter;
use function intrawarez\sabertooth\fn\repeatables\first;
use intrawarez\sabertooth\optionals\OptionalInterface;

final class ClassMetadata extends AbstractMetadata
{
    private static function getMethods(\ReflectionClass $class, $filter = null): array
    {
        $methods = $class->getMethods($filter);
        
        while ($class = $class->getParentClass()) {
            $methods = array_merge($methods, $class->getMethods());
        }
        
        return $methods;
    }
    
    private static function getProperties(\ReflectionClass $class): array
    {
        $properties = $class->getProperties();
        
        while ($class = $class->getParentClass()) {
            $properties = array_merge($properties, $class->getProperties());
        }
        
        return $properties;
    }
    
    /**
     * @var \ReflectionClass
     */
    private $reflectionClass;
    
    /**
     * @var OptionalInterface
     */
    private $groupDeclarationOptional;
    
    /**
     * @var OptionalInterface
     */
    private $methodDeclarationOptional;
    
    /**
     * @var OptionalInterface
     */
    private $middlewareDeclarationOptional;
    
    /**
     * @var OptionalInterface
     */
    private $middlewaresDeclarations;
    
    /**
     * @var array
     */
    private $methodMetadata = [];
    
    /**
     * @var array
     */
    private $propertyMetadata = [];
    
    /**
     * Constructs a new ClassMetadata instnance.
     * @param \ReflectionClass $reflectionClass
     */
    public function __construct(\ReflectionClass $reflectionClass, Reader $reader)
    {
        parent::__construct($reflectionClass, $reader);
        
        $this->reflectionClass = $reflectionClass;
        
        $this->groupDeclarationOptional = first(filter($this->getAnnotations(), _instanceOf(Group::class)));
        $this->methodDeclarationOptional = first(filter($this->getAnnotations(), _instanceOf(Action::class)));
        $this->middlewareDeclarations = filter($this->getAnnotations(), _instanceOf(Middleware::class));
        
        foreach (self::getMethods($this->reflectionClass, \ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            $methodMetadata = new MethodMetadata($this, $reflectionMethod, $reader);
            if ($methodMetadata->isAnnotated()) {
                $this->methodMetadata[] = $methodMetadata;
            }
        }
        
        foreach (self::getProperties($this->reflectionClass) as $reflectionProperty) {
            $propertyMetadata = new PropertyMetadata($this, $reflectionProperty, $reader);
            if ($propertyMetadata->isAnnotated()) {
                $this->propertyMetadata[] = $propertyMetadata;
            }
        }
    }
    
    public function getReflectionClass(): \ReflectionClass
    {
        return $this->reflectionClass;
    }
    
    public function isGroupDeclaration(): bool
    {
        return $this->groupDeclarationOptional->isPresent();
    }
    
    public function getGroupDeclaration(): Group
    {
        return $this->groupDeclarationOptional->get();
    }
    
    public function isActionDeclaration(): bool
    {
        return $this->methodDeclarationOptional->isPresent();
    }
    
    public function getActionDeclaration(): Action
    {
        return $this->methodDeclarationOptional->get();
    }
    
    public function hasMiddlewares(): bool
    {
        return count($this->middlewaresDeclarations) > 0;
    }
    
    public function getMiddlewareDeclarations(): array
    {
        return $this->middlewaresDeclarations;
    }
    
    public function getMethodMetadata(): array
    {
        return $this->methodMetadata;
    }
    
    public function getPropertyMetadata(): array
    {
        return $this->propertyMetadata;
    }
}
