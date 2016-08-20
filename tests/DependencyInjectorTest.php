<?php

use PHPUnit\Framework\TestCase;
use intrawarez\slim3annotations\annotations\Dependency;
use Slim\Container;
use intrawarez\slim3annotations\DependencyInjector;

class DummyDependency {}

class DummyInjectionTarget {
	
	
	/**
	 * @Dependency(id="dep1")
	 * @var DummyDependency
	 */
	private $dependency1;
	

	/**
	 * @Dependency(id="dep1")
	 * @var DummyDependency
	 */
	private $dependency2;
	
}

class DependencyInjectorTest extends TestCase {
	
	public function testNewInstance () {
		
		$container = [];
		
		$container["dep1"] = function ($container) {
			
			return new DummyDependency();
			
		};
		
		$class = new ReflectionClass(DummyInjectionTarget::class);
		
		$instance = DependencyInjector::newInstance($class, new Container($container));
		
		$this->assertAttributeInstanceOf(DummyDependency::class, "dependency1", $instance);
		$this->assertAttributeInstanceOf(DummyDependency::class, "dependency2", $instance);
		
		
		
	}
	
}

?>