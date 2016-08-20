<?php

use PHPUnit\Framework\TestCase;

use intrawarez\slim3annotations\annotations\Group;
use intrawarez\slim3annotations\annotations\Middleware;
use intrawarez\slim3annotations\annotations\Dependency;
use intrawarez\slim3annotations\annotations\Method;
use intrawarez\slim3annotations\annotations\GET;
use intrawarez\slim3annotations\annotations\Annotations;
use intrawarez\sabertooth\optionals\OptionalInterface;
use Doctrine\Common\Annotations\AnnotationRegistry;

class DummyNotAnnotatedClass {
	
	private $property;
	
	public function method () {}
	
}

/**
 * 
 * @Group(pattern="/dummy")
 * @Middleware(name="Middleware1")
 * @Middleware(name="Middleware2")
 *
 */
class DummyAnnotatedClass {
	
	
	/**
	 * @Dependency(id="dep")
	 * @var unknown
	 */
	private $property;
	
	/**
	 * @GET
	 * @Middleware(name="Middleware3")
	 * @Middleware(name="Middleware4")
	 */
	public function method () {}
	

	
	
}

class AnnotationsTest extends TestCase {
	
	static private function newNotAnnotatedClass () : \ReflectionClass {
		
		return new \ReflectionClass(DummyNotAnnotatedClass::class);
		
	}
	
	static private function newAnnotatedClass () : \ReflectionClass {
		
		return new \ReflectionClass(DummyAnnotatedClass::class);
		
	}
	
	
	
	/**
	 * @covers Doctrine\Common\Annotations\AnnotationRegistry::registerFile
	 * @covers \intrawarez\slim3annotations\annotations\Annotations::Reader
	 * @covers \intrawarez\slim3annotations\annotations\Annotations::Group
	 */
	public function testGroup () {
		
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
	/**
	 * @covers \intrawarez\slim3annotations\annotations\Annotations::Reader
	 * @covers \intrawarez\slim3annotations\annotations\Annotations::GroupMiddlewares
	 */
	public function testGroupeMiddlewares () {
		
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
	/**
	 * @covers \intrawarez\slim3annotations\annotations\Annotations::Reader
	 * @covers \intrawarez\slim3annotations\annotations\Annotations::Dependency
	 */
	public function testDependency () {
		
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
	/**
	 * @covers \intrawarez\slim3annotations\annotations\Annotations::Reader
	 * @covers \intrawarez\slim3annotations\annotations\Annotations::Method
	 */
	public function testMethod () {
		
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
	/**
	 * @covers \intrawarez\slim3annotations\annotations\Annotations::Reader
	 * @covers \intrawarez\slim3annotations\annotations\Annotations::MethodMiddlewares
	 */
	public function testMethodMiddlewares () {
		
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

?>