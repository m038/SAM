<?php
namespace intrawarez\slimannotations\metadata;

use Doctrine\Common\Annotations\Reader;
use function intrawarez\sabertooth\fn\predicates\_instanceOf;
use function intrawarez\sabertooth\fn\repeatables\filter;
use function intrawarez\sabertooth\fn\repeatables\first;
use intrawarez\sabertooth\optionals\OptionalInterface;
use intrawarez\slimannotations\annotations\Dependency;

final class PropertyMetadata extends AbstractMetadata
{
    /**
     * @var \ReflectionProperty
     */
    private $reflectionProperty;
    
    /**
     * @var OptionalInterface
     */
    private $dependencyOptional;
    
    public function __construct(\ReflectionProperty $reflectionProperty, Reader $reader)
    {
        parent::__construct($reflectionProperty, $reader);
        
        $this->reflectionProperty = $reflectionProperty;
        
        $this->dependencyOptional = first(filter($this->getAnnotations(), _instanceOf(Dependency::class)));
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
