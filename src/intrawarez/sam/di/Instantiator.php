<?php
namespace intrawarez\sam\di;

use Interop\Container\ContainerInterface;
use intrawarez\sam\metadata\ClassMetadata;
use intrawarez\sam\metadata\PropertyMetadata;

final class Instantiator
{
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function createInstance(ClassMetadata $classMetadata)
    {
        $instance = $classMetadata->getReflectionClass()->newInstanceWithoutConstructor();
        
        foreach ($classMetadata->getPropertyMetadata() as $propertyMetadata) {
            /**
             * @var PropertyMetadata $propertyMetadata
             */
            if ($propertyMetadata->isDependency() && $this->container->has($propertyMetadata->getDependency()->getId())) {
                $reflectionProperty = $propertyMetadata->getReflectionProperty();
                $reflectionProperty->setAccessible(true);
                $reflectionProperty->setValue($instance, $this->container->get($propertyMetadata->getDependency()->getId()));
                $reflectionProperty->setAccessible(false);
            }
        }
        
        return $instance;
    }    
}
