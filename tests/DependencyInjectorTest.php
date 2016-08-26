<?php
namespace intrawarez\slimannotations\tests;

use PHPUnit\Framework\TestCase;
use intrawarez\slimannotations\DependencyInjector;
use Slim\Container;

include_once __DIR__."/DummyDependency.php";
include_once __DIR__."/DummyInjectionTarget.php";

class DependencyInjectorTest extends TestCase
{

    public function testNewInstance()
    {
        $container = [];
        
        $container["dep1"] = function ($container) {
            
            return new DummyDependency();
        };
        
        $class = new \ReflectionClass(DummyInjectionTarget::class);
        
        $instance = DependencyInjector::newInstance($class, new Container($container));
        
        $this->assertAttributeInstanceOf(DummyDependency::class, "dependency1", $instance);
        $this->assertAttributeInstanceOf(DummyDependency::class, "dependency2", $instance);
    }
}
