<?php

namespace intrawarez\slim3annotations;

use Interop\Container\ContainerInterface;
use intrawarez\slim3annotations\annotations\Annotations;
use intrawarez\slim3annotations\annotations\Dependency;


/**
 * Abstract implementation of delgates.
 * 
 * @author maxmeffert
 *
 */
abstract class DependencyInjector {
		
	/**
	 * Creates a new instance of a given reflection class with injected dependencies from a given container.
	 * 
	 * @param \ReflectionClass $class The given reflection class.
	 * @param ContainerInterface $container The given container.
	 * @return object
	 */
	static final public function newInstance(\ReflectionClass $class, ContainerInterface $container) {
		
		if ($class->getConstructor()) {
			
			$instance = $class->newInstance($container);
			
		}
		else {
			
			$instance = $class->newInstance();
			
		}
		
		foreach ($class->getProperties() as $property) {
			
			/**
			 * @var \ReflectionProperty $property
			 */
			
			$dependency = Annotations::Dependency($property);
			
			if ($dependency->isPresent()) {
				
				/**
				 * 
				 * @var Dependency $dependency
				 */
				$dependency = $dependency->get();
				
				$id = $dependency->id;
				
				if ($container->has($id)) {
					
					$property->setAccessible(true);
					$property->setValue($instance, $container->get($id));
					$property->setAccessible(false);
					
				}
				
			}
			
		}
		
		return $instance;
		
	}
	
}


?>