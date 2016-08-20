<?php

use PHPUnit\Framework\TestCase;
use intrawarez\slim3annotations\CallableResolver;
use intrawarez\slim3annotations\GroupMethodDelegate;
use Slim\Container;

class CallableResolverTest extends TestCase {
	
	public function testResolve () {
		
		$container = new Container();
		
		$resolver = new CallableResolver($container);
		$defaultResolver = new \Slim\CallableResolver($container);
		
		$deletate = new GroupMethodDelegate(CallableResolverTest::class, "testResolve");
		$nonDelegate = function(){};
		
		$this->assertEquals($defaultResolver->resolve($nonDelegate), $resolver->resolve($nonDelegate));
		
		$this->expectException(\RuntimeException::class);
		$this->assertNotEquals($defaultResolver->resolve($deletate), $resolver->resolve($deletate));
		
	}
	
}

?>