<?php
namespace intrawarez\slimannotations;

use Interop\Container\ContainerInterface;
use intrawarez\slimannotations\metadata\ClassMetadata;
use intrawarez\slimannotations\metadata\PropertyMetadata;

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
            if ($propertyMetadata->isDependency() && $this->container->has($propertyMetadata->getDependency()->id)) {
                $reflectionProperty = $propertyMetadata->getReflectionProperty();
                $reflectionProperty->setAccessible(true);
                $reflectionProperty->setValue($instance, $this->container->get($propertyMetadata->getDependency()->id));
                $reflectionProperty->setAccessible(false);
            }
        }
        
        return $instance;
    }
}
