<?php
namespace intrawarez\slimannotations\metadata;

use Doctrine\Common\Annotations\Reader;
use intrawarez\slimannotations\annotations\Group;
use intrawarez\slimannotations\annotations\HttpMethod;
use intrawarez\slimannotations\annotations\Middleware;
use intrawarez\slimannotations\annotations\Middlewares;
use function intrawarez\sabertooth\fn\predicates\_instanceOf;
use function intrawarez\sabertooth\fn\repeatables\filter;
use function intrawarez\sabertooth\fn\repeatables\first;
use intrawarez\sabertooth\optionals\OptionalInterface;

final class ClassMetadata extends AbstractMetadata
{
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
    private $middlewaresDeclarationOptional;
    
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
        $this->methodDeclarationOptional = first(filter($this->getAnnotations(), _instanceOf(HttpMethod::class)));
        $this->middlewareDeclarationOptional = first(filter($this->getAnnotations(), _instanceOf(Middleware::class)));
        $this->middlewaresDeclarationOptional = first(filter($this->getAnnotations(), _instanceOf(Middlewares::class)));
        
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            $methodMetadata = new MethodMetadata($this, $reflectionMethod, $reader);
            if ($methodMetadata->isAnnotated()) {
                $this->methodMetadata[] = $methodMetadata;
            }
        }
        
        foreach ($reflectionClass->getProperties() as $reflectionProperty) {
            $propertyMetadata = new PropertyMetadata($this, $reflectionProperty, $reader);
            if ($propertyMetadata->isAnnotated()) {
                $this->propertyMetadata[] = $propertyMetadata;
            }
        }
        
        $this->validate();
    }
    
    private function validate()
    {
        $isInvalid = (
            ($this->isGroupDeclaration() && $this->isMiddlewareDeclaration())
            || ($this->isGroupDeclaration() && $this->isActionDeclaration())
            || ($this->isActionDeclaration() && $this->isMiddlewareDeclaration())
        );
        
        if ($isInvalid) {
            throw new \LogicException("Class can only be either Group, Action (i.e. GET, POST, PUT, DELETE, etc.) or Middleware declaration!");
        }
        
        $isInvalidAction = (
            $this->isActionDeclaration()
            && !$this->getReflectionClass()->hasMethod("__invoke")
            && !$this->getReflectionClass()->getMethod("__invoke")->isPublic()
        );
        
        if ($isInvalidAction) {
            throw new \LogicException("Class Action declarations have to implement the '__invoke' method!");
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
    
    public function isMiddlewareDeclaration(): bool
    {
        return $this->middlewareDeclarationOptional->isPresent();
    }
    
    public function getMiddlewareDeclaration(): Middleware
    {
        return $this->middlewareDeclarationOptional->get();
    }
    
    public function isActionDeclaration(): bool
    {
        return $this->methodDeclarationOptional->isPresent();
    }
    
    public function getActionDeclaration(): HttpMethod
    {
        return $this->methodDeclarationOptional->get();
    }
    
    public function hasMiddlewares(): bool
    {
        return $this->middlewaresDeclarationOptional->isPresent();
    }
    
    public function getMiddlewares(): Middlewares
    {
        return $this->middlewaresDeclarationOptional->get();
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
