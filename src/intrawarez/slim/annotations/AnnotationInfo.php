<?php

namespace intrawarez\slim\annotations;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationException;

/**
 * 
 * A collection of utility functions for reading slim annotations.
 * 
 * @author maxmeffert
 *
 */
abstract class AnnotationInfo {
	
	static private $reader;
	
	static private function getReader () {
		
		if (is_null(self::$reader)) {
			
			self::$reader = new AnnotationReader();
			
		}
		
		return self::$reader;
		
	}
	
	static public function annotationsOf (\Reflector $reflector) {
		
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
	
	static public function routeOf (\Reflector $reflector) {
		
		return self::annotationOf($reflector, Route::class);
		
	}
	
	static public function methodOf (\Reflector $reflector) {
		
		return self::annotationOf($reflector, Method::class);
		
	}
	
	static public function middlewaresOf (\Reflector $reflector) {
		
		return array_filter(self::annotationsOf($reflector), function($annotation){
			return $annotation instanceof \intrawarez\sabertooth\slim\annotations\Middleware;
		});
		
	}
	
	
	
	
}

?>