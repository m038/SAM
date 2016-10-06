<?php
namespace intrawarez\slimannotations\annotations;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use intrawarez\sabertooth\optionals\Optional;
use intrawarez\sabertooth\optionals\OptionalInterface;
use function intrawarez\sabertooth\util\repeatables\fn\filter;
use function intrawarez\sabertooth\callables\predicates\fn\_instanceOf;

abstract class Annotations
{

    /**
     * The annotation reader.
     *
     * @var AnnotationReader
     */
    private static $reader;

    /**
     * Gets the singleton instance of an annotation reader.
     *
     * @return AnnotationReader
     */
    final private static function reader(): AnnotationReader
    {
        if (is_null(self::$reader)) {
            AnnotationRegistry::registerFile(__DIR__ . "/Group.php");
            AnnotationRegistry::registerFile(__DIR__ . "/Middleware.php");
            AnnotationRegistry::registerFile(__DIR__ . "/Dependency.php");
            AnnotationRegistry::registerFile(__DIR__ . "/Group.php");
            AnnotationRegistry::registerFile(__DIR__ . "/GET.php");
            AnnotationRegistry::registerFile(__DIR__ . "/POST.php");
            AnnotationRegistry::registerFile(__DIR__ . "/PUT.php");
            AnnotationRegistry::registerFile(__DIR__ . "/DELETE.php");
            AnnotationRegistry::registerFile(__DIR__ . "/PATCH.php");
            AnnotationRegistry::registerFile(__DIR__ . "/OPTIONS.php");
            AnnotationRegistry::registerFile(__DIR__ . "/ANY.php");
            
            self::$reader = new AnnotationReader();
        }
        
        return self::$reader;
    }

    /**
     *
     * @param \ReflectionClass $class
     * @return OptionalInterface
     */
    final public static function group(\ReflectionClass $class): OptionalInterface
    {
        $group = self::reader()->getClassAnnotation($class, Group::class);
        
        return Optional::Of($group);
    }

    /**
     *
     * @param \ReflectionClass $class
     * @return array
     */
    final public static function groupMiddlewares(\ReflectionClass $class): array
    {
        $annotations = self::reader()->getClassAnnotations($class);
        
        // normalize index with array_slice
        return array_slice(filter($annotations, _instanceOf(Middleware::class)), 0);
    }

    /**
     *
     * @param \ReflectionProperty $property
     * @return OptionalInterface
     */
    final public static function dependency(\ReflectionProperty $property): OptionalInterface
    {
        $dependency = self::reader()->getPropertyAnnotation($property, Dependency::class);
        
        return Optional::Of($dependency);
    }

    /**
     *
     * @param \ReflectionMethod $method
     * @return OptionalInterface
     */
    final public static function method(\ReflectionMethod $method): OptionalInterface
    {
        $method = self::reader()->getMethodAnnotation($method, Method::class);
        
        return Optional::Of($method);
    }

    /**
     *
     * @param \ReflectionMethod $method
     * @return array
     */
    final public static function methodMiddlewares(\ReflectionMethod $method): array
    {
        $annotations = self::reader()->getMethodAnnotations($method);
        
        return array_slice(filter($annotations, _instanceOf(Middleware::class)), 0);
    }
}
