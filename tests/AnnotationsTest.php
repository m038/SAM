<?php
namespace intrawarez\slimannotations\tests;

use PHPUnit\Framework\TestCase;
use intrawarez\slimannotations\annotations\Group;
use intrawarez\slimannotations\annotations\Middleware;
use intrawarez\slimannotations\annotations\Dependency;
use intrawarez\slimannotations\annotations\Method;
use intrawarez\slimannotations\annotations\GET;
use intrawarez\slimannotations\annotations\Annotations;
use intrawarez\sabertooth\optionals\OptionalInterface;
use Doctrine\Common\Annotations\AnnotationRegistry;

include_once __DIR__."/DummyNotAnnotatedClass.php";
include_once __DIR__."/DummyAnnotatedClass.php";

class AnnotationsTest extends TestCase
{

    private static function newNotAnnotatedClass(): \ReflectionClass
    {
        return new \ReflectionClass(DummyNotAnnotatedClass::class);
    }

    private static function newAnnotatedClass(): \ReflectionClass
    {
        return new \ReflectionClass(DummyAnnotatedClass::class);
    }
        
    public function testGroup()
    {
        $result = Annotations::Group(self::newNotAnnotatedClass());
        
        $this->assertInstanceOf(OptionalInterface::class, $result);
        $this->assertTrue($result->isAbsent());
        $this->assertFalse($result->isPresent());
        
        $result = Annotations::Group(self::newAnnotatedClass());
        
        $this->assertInstanceOf(OptionalInterface::class, $result);
        $this->assertTrue($result->isPresent());
        $this->assertFalse($result->isAbsent());
        
        $group = $result->get();
        
        $this->assertInstanceOf(Group::class, $group);
        $this->assertAttributeContains("/dummy", "pattern", $group);
    }

    public function testGroupeMiddlewares()
    {
        $results = Annotations::GroupMiddlewares(self::newNotAnnotatedClass());
        
        $this->assertInternalType("array", $results);
        $this->assertEquals(0, count($results));
        
        $results = Annotations::GroupMiddlewares(self::newAnnotatedClass());
        
        $this->assertInternalType("array", $results);
        $this->assertEquals(2, count($results));
        
        foreach ($results as $result) {
            $this->assertInstanceOf(Middleware::class, $result);
        }
        
        $this->assertAttributeEquals("Middleware1", "name", $results[0]);
        $this->assertAttributeEquals("Middleware2", "name", $results[1]);
    }

    public function testDependency()
    {
        $result = Annotations::Dependency(self::newNotAnnotatedClass()->getProperty("property"));
        
        $this->assertInstanceOf(OptionalInterface::class, $result);
        $this->assertTrue($result->isAbsent());
        $this->assertFalse($result->isPresent());
        
        $result = Annotations::Dependency(self::newAnnotatedClass()->getProperty("property"));
        
        $this->assertInstanceOf(OptionalInterface::class, $result);
        $this->assertTrue($result->isPresent());
        $this->assertFalse($result->isAbsent());
        
        $dependency = $result->get();
        
        $this->assertInstanceOf(Dependency::class, $dependency);
        $this->assertAttributeContains("dep", "id", $dependency);
    }

    public function testMethod()
    {
        $result = Annotations::Method(self::newNotAnnotatedClass()->getMethod("method"));
        
        $this->assertInstanceOf(OptionalInterface::class, $result);
        $this->assertTrue($result->isAbsent());
        $this->assertFalse($result->isPresent());
        
        $result = Annotations::Method(self::newAnnotatedClass()->getMethod("method"));
        
        $this->assertInstanceOf(OptionalInterface::class, $result);
        $this->assertTrue($result->isPresent());
        $this->assertFalse($result->isAbsent());
        $this->assertInstanceOf(Method::class, $result->get());
        $this->assertInstanceOf(GET::class, $result->get());
    }

    public function testMethodMiddlewares()
    {
        $results = Annotations::MethodMiddlewares(self::newNotAnnotatedClass()->getMethod("method"));
        
        $this->assertInternalType("array", $results);
        $this->assertEquals(0, count($results));
        
        $results = Annotations::MethodMiddlewares(self::newAnnotatedClass()->getMethod("method"));
        
        $this->assertInternalType("array", $results);
        $this->assertEquals(2, count($results));
        
        foreach ($results as $result) {
            $this->assertInstanceOf(Middleware::class, $result);
        }
        
        $this->assertAttributeEquals("Middleware3", "name", $results[0]);
        $this->assertAttributeEquals("Middleware4", "name", $results[1]);
    }
}
