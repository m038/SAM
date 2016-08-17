<?php

namespace intrawarez\slim3annotations\annotations;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

use intrawarez\sabertooth\optionals\Optional;
use intrawarez\sabertooth\optionals\OptionalInterface;

use function intrawarez\sabertooth\util\repeatables\fn\filter;
use function intrawarez\sabertooth\callables\predicates\fn\_instanceOf;

AnnotationRegistry::registerFile(__DIR__."/Group.php");
AnnotationRegistry::registerFile(__DIR__."/Middleware.php");
AnnotationRegistry::registerFile(__DIR__."/Dependency.php");
AnnotationRegistry::registerFile(__DIR__."/Group.php");
AnnotationRegistry::registerFile(__DIR__."/GET.php");
AnnotationRegistry::registerFile(__DIR__."/POST.php");
AnnotationRegistry::registerFile(__DIR__."/PUT.php");
AnnotationRegistry::registerFile(__DIR__."/DELETE.php");
AnnotationRegistry::registerFile(__DIR__."/OPTIONS.php");
AnnotationRegistry::registerFile(__DIR__."/ANY.php");

abstract class Annotations {
	
	/**
	 * The annotation reader.
	 *
	 * @var AnnotationReader
	 */
	static private $reader;
	
	/**
	 * Gets the singleton instance of an annotation reader.
	 * 
	 * @return AnnotationReader
	 */
	static final public function Reader () : AnnotationReader {
	
		if (is_null(self::$reader)) {
	
			self::$reader = new AnnotationReader();
	
		}
	
		return self::$reader;
	
	}
	
	/**
	 * 
	 * @param \ReflectionClass $class
	 * @return OptionalInterface
	 */
	static final public function Group (\ReflectionClass $class) : OptionalInterface {
		
		$group = self::Reader()->getClassAnnotation($class, Group::class);
		
		return Optional::Of($group);
		
	}
	
	/**
	 * 
	 * @param \ReflectionClass $class
	 * @return array
	 */
	static final public function GroupMiddlewares (\ReflectionClass $class) : array {
		
		$annotations = self::Reader()->getClassAnnotations($class);
		
		return filter($annotaions, _instanceOf(Middleware::class));
		
	}
	
	/**
	 * 
	 * @param \ReflectionProperty $property
	 * @return OptionalInterface
	 */
	static final public function Dependency (\ReflectionProperty $property) : OptionalInterface {
		
		$dependency = self::Reader()->getPropertyAnnotation($property, Dependency::class);
		
		return Optional::Of($dependency);
		
	}
	
	/**
	 * 
	 * @param \ReflectionMethod $method
	 * @return OptionalInterface
	 */
	static final public function Method (\ReflectionMethod $method) : OptionalInterface {
		
		$method = self::Reader()->getMethodAnnotation($method, Method::class);
		
		return Optional::Of($method);
		
	}
	
	/**
	 * 
	 * @param \ReflectionMethod $method
	 * @return array
	 */
	static final public function MethodMiddlewares (\ReflectionMethod $method) : array {
		
		$annotations = self::Reader()->getMethodAnnotations($method);
		
		return filter($annotations, _instanceOf(Middleware::class));
		
	}
	
	
	
}


?>