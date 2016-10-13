<?php
namespace intrawarez\slam\metadata;

use Doctrine\Common\Annotations\Reader;
use function intrawarez\sabertooth\fn\predicates\_instanceOf;
use function intrawarez\sabertooth\fn\repeatables\filter;
use function intrawarez\sabertooth\fn\repeatables\first;
use intrawarez\sabertooth\optionals\OptionalInterface;
use intrawarez\slam\annotations\Dependency;

final class PropertyMetadata extends AbstractMetadata
{
    private $classMetadata;
    /**
     * @var \ReflectionProperty
     */
    private $reflectionProperty;
    
    /**
     * @var OptionalInterface
     */
    private $dependencyOptional;
    
    public function __construct(ClassMetadata $classMetadata, \ReflectionProperty $reflectionProperty, Reader $reader)
    {
        parent::__construct($reflectionProperty, $reader);
        
        $this->classMetadata = $classMetadata;
        $this->reflectionProperty = $reflectionProperty;
        
        $this->dependencyOptional = first(filter($this->getAnnotations(), _instanceOf(Dependency::class)));
    }
    
    public function getClassMetadata(): ClassMetadata
    {
        return $this->classMetadata;
    }
    
    public function getReflectionProperty(): \ReflectionProperty
    {
        return $this->reflectionProperty;
    }
    
    public function isDependency(): bool
    {
        return $this->dependencyOptional->isPresent();
    }
    
    public function getDependency(): Dependency
    {
        return $this->dependencyOptional->get();
    }
}
