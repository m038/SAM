<?php
namespace intrawarez\slimannotations\metadata;

use Doctrine\Common\Annotations\Reader;
use intrawarez\slimannotations\annotations\Group;
use intrawarez\slimannotations\annotations\HttpMethod;
use intrawarez\slimannotations\annotations\Middleware;

use function intrawarez\sabertooth\callables\predicates\fn\_instanceOf;
use function intrawarez\sabertooth\util\repeatables\fn\some;

final class ClassMetadata extends AbstractMetadata
{
    private $isGroupDeclaration;
    private $isMethodDeclaration;
    private $isMiddlewareDeclaration;
    
    private $methodMetadata = [];
    private $propertyMetadata = [];
    
    /**
     * Constructs a new ClassMetadata instnance.
     * @param \ReflectionClass $reflectionClass
     */
    public function __construct(\ReflectionClass $reflector, Reader $reader)
    {
        parent::__construct($reflector, $reader);
        
        $this->isGroupDeclaration = some($this->getAnnotations(), _instanceOf(Group::class));
        $this->isMethodDeclaration = some($this->getAnnotations(), _instanceOf(HttpMethod::class));
        $this->isMiddlewareDeclaration = some($this->getAnnotations(), _instanceOf(Middleware::class));
        
        $inValid = (
            ($this->isGroupDeclaration && $this->isMethodDeclaration)
            || ($this->isGroupDeclaration && $this->isMiddlewareDeclaration)
            || ($this->isMethodDeclaration && $this->isMiddlewareDeclaration)
        );
        
        if ($inValid) {
            throw new \LogicException("Class can only be either Group, Method or Middleware declaration!");
        }
        
        foreach ($reflector->getMethods(\ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
            $this->methodMetadata[] = new MethodMetadata($reflectionMethod, $reader);
        }
        
        foreach ($reflector->getProperties() as $reflectionProperty) {
            $this->propertyMetadata[] = new PropertyMetadata($reflectionProperty, $reader);
        }
    }
    
    public function getReflectionClass(): \ReflectionClass
    {
        return $this->reflectionClass;
    }
    
    public function isGroupDeclaration(): bool
    {
        return false;
    }
    
    public function isMiddlewareDeclaration(): bool
    {
        return false;
    }
    
    public function isActionDeclaration(): bool
    {
        return false;
    }
    
    public function getMethodMetadata(): array
    {
        return [];
    }
    
    public function getPropertyMetadata(): array
    {
        return [];
    }
}