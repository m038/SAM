<?php

namespace intrawarez\slim3annotations\annotations;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationException;


AnnotationRegistry::registerFile(__DIR__."/Route.php");
AnnotationRegistry::registerFile(__DIR__."/Middleware.php");
AnnotationRegistry::registerFile(__DIR__."/Group.php");
AnnotationRegistry::registerFile(__DIR__."/GET.php");
AnnotationRegistry::registerFile(__DIR__."/POST.php");
AnnotationRegistry::registerFile(__DIR__."/PUT.php");
AnnotationRegistry::registerFile(__DIR__."/DELETE.php");
AnnotationRegistry::registerFile(__DIR__."/OPTIONS.php");
AnnotationRegistry::registerFile(__DIR__."/ANY.php");

/**
 * 
 * A collection of utility functions for reading slim annotations.
 * 
 * @author maxmeffert
 *
 */
abstract class SlimAnnotations {
	
	/**
	 * 
	 * @var \Doctrine\Common\Annotations\AnnotationReader
	 */
	static private $reader;
	
	/**
	 * 
	 * @return \Doctrine\Common\Annotations\AnnotationReader
	 */
	static private function getReader () : AnnotationReader {
		
		if (is_null(self::$reader)) {
			
			self::$reader = new AnnotationReader();
			
		}
		
		return self::$reader;
		
	}
	
	/**
	 * 
	 * @param \Reflector $reflector
	 * @throws AnnotationException
	 */
	static public function annotationsOf (\Reflector $reflector) : array {
		
		if ($reflector instanceof \ReflectionClass) {
			
			return self::getReader()->getClassAnnotations($reflector);
			
		}
		
		if ($reflector instanceof \ReflectionMethod) {
			
			return self::getReader()->getMethodAnnotations($reflector);
			
		}
		
		if ($reflector instanceof \ReflectionProperty) {
			
			return self::getReader()->getPropertyAnnotations($reflector);
			
		}
		
		throw new AnnotationException("Reflector must be either instance of ReflectionClass, ReflectionMethod or ReflectionProperty");
		
	}
	
	/**
	 * 
	 * @param \Reflector $reflector
	 * @param unknown $annotationName
	 * @throws AnnotationException
	 * @return object|null
	 */
	static public function annotationOf (\Reflector $reflector, $annotationName) {
	
		if ($reflector instanceof \ReflectionClass) {
			
			return self::getReader()->getClassAnnotation($reflector, $annotationName);
				
		}
	
		if ($reflector instanceof \ReflectionMethod) {
				
			return self::getReader()->getMethodAnnotation($reflector, $annotationName);
				
		}
	
		if ($reflector instanceof \ReflectionProperty) {
				
			return self::getReader()->getPropertyAnnotation($reflector, $annotationName);
				
		}
	
		throw new AnnotationException("Reflector must be either instance of ReflectionClass, ReflectionMethod or ReflectionProperty");
	
	}
	
	/**
	 * 
	 * @param \Reflector $reflector
	 * @return Route
	 */
	static public function routeOf (\Reflector $reflector)  {
		
		return self::annotationOf($reflector, Route::class);
		
	}
	
	/**
	 * 
	 * @param \Reflector $reflector
	 * @return Method
	 */
	static public function methodOf (\Reflector $reflector)  {
		
		return self::annotationOf($reflector, Method::class);
		
	}
	
	/**
	 * 
	 * @param \Reflector $reflector
	 * @return Middleware
	 */
	static public function middlewaresOf (\Reflector $reflector)  {
		
		return array_filter(self::annotationsOf($reflector), function($annotation){
			return $annotation instanceof \intrawarez\sabertooth\slim\annotations\Middleware;
		});
		
	}
	
	
	
	
}

?>