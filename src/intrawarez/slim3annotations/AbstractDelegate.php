<?php

namespace intrawarez\slim3annotations;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\AnnotationReader;
use Interop\Container\ContainerInterface;
use intrawarez\sabertooth\reflection\Reflections;
use intrawarez\slim3annotations\annotations\Dependency;

AnnotationRegistry::registerFile(__DIR__."/annotations/Group.php");
AnnotationRegistry::registerFile(__DIR__."/annotations/Middleware.php");
AnnotationRegistry::registerFile(__DIR__."/annotations/Dependency.php");
AnnotationRegistry::registerFile(__DIR__."/annotations/Group.php");
AnnotationRegistry::registerFile(__DIR__."/annotations/GET.php");
AnnotationRegistry::registerFile(__DIR__."/annotations/POST.php");
AnnotationRegistry::registerFile(__DIR__."/annotations/PUT.php");
AnnotationRegistry::registerFile(__DIR__."/annotations/DELETE.php");
AnnotationRegistry::registerFile(__DIR__."/annotations/OPTIONS.php");
AnnotationRegistry::registerFile(__DIR__."/annotations/ANY.php");

abstract class AbstractDelegate implements DelegateInterface {
	
	/**
	 * The annotation reader.
	 * 
	 * @var AnnotationReader
	 */
	static private $reader;
	
	/**
	 * 
	 * @return AnnotationReader
	 */
	static final public function AnnotationReader () : AnnotationReader {
	
		if (is_null(self::$reader)) {
				
			self::$reader = new AnnotationReader();
				
		}
	
		return self::$reader;
	
	}
	
	static final public function newInstance(\ReflectionClass $class, ContainerInterface $container) {
		
		if ($class->getConstructor()) {
			
			$instance = $class->newInstanceArgs($container);
			
		}
		else {
			
			$instance = $class->newInstance();
			
		}
		
		foreach ($class->getProperties() as $property) {
			
			/**
			 * @var \ReflectionProperty $property
			 */
			
			$dependency = self::AnnotationReader()->getPropertyAnnotation($property, Dependency::class);
			
			if ($dependency instanceof Dependency) {
				
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