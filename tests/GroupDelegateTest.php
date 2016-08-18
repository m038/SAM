<?php

use PHPUnit\Framework\TestCase;
use intrawarez\slim3annotations\GroupDelegate;
use intrawarez\slim3annotations\annotations\GET;
use Slim\Container;
use intrawarez\slim3annotations\App;
use intrawarez\slim3annotations\GroupMethodDelegate;

class DummyGroupDelegateTarget {
	
	/**
	 * @GET
	 */
	public function method1 () {
		
	}
	
	/**
	 * @GET
	 */
	public function method2 () {
	
	}
	
}

class MockAppDeegateRecord {
	
	public $method;
	public $pattern;
	public $callable;
	
}

class MockApp extends App {
	
	private $delegates = [];
	
	public function getDelegates () {
		
		return $this->delegates;
		
	}
	
	private function addDelegate ($method, $pattern, $callable) {
	
		$delegate = new MockAppDeegateRecord();
		$delegate->method = $method;
		$delegate->pattern = $pattern;
		$delegate->callable = $callable;
		
		array_push($this->delegates, $delegate);
		
	}
	
	public function get ($pattern, $callable) {
		
		$this->addDelegate("get", $pattern, $callable);
		
		return parent::get($pattern, $callable);
		
	}
	
	public function post ($pattern, $callable) {
		
		$this->addDelegate("post", $pattern, $callable);
		
		return parent::post($pattern, $callable);
		
	}
	
	public function put ($pattern, $callable) {
		
		$this->addDelegate("put", $pattern, $callable);
		
		return parent::put($pattern, $callable);
		
	}
	
	public function delete ($pattern, $callable) {
		
		$this->addDelegate("delete", $pattern, $callable);
		
		return parent::delete($pattern, $callable);
		
	}
	
	public function options ($pattern, $callable) {
		
		$this->addDelegate("options", $pattern, $callable);
		
		return parent::options($pattern, $callable);
		
	}


	public function patch ($pattern, $callable) {
	
		$this->addDelegate("patch", $pattern, $callable);
	
		return parent::patch($pattern, $callable);
	
	}


	public function any ($pattern, $callable) {
	
		$this->addDelegate("any", $pattern, $callable);
	
		return parent::any($pattern, $callable);
	
	}
	
}

class GroupDelegateTest extends TestCase {
	
	public function test () {
		
		$delegate = new GroupDelegate(DummyGroupDelegateTarget::class);
		
		/**
		 * @var Closure $callable
		 */	
		$callable = $delegate->getCallable(new Container());
		
		$this->assertInstanceOf(Closure::class, $callable);
		
	
		$app = new MockApp();
		
		$callable->call($app);
		
		$delegates = $app->getDelegates();
		
		$this->assertGreaterThan(0, count($delegates));
		$this->assertAttributeEquals("get", "method", $delegates[0]);
		$this->assertAttributeEquals("", "pattern", $delegates[0]);
		$this->assertAttributeInstanceOf(GroupMethodDelegate::class, "callable", $delegates[0]);
		$this->assertAttributeEquals(DummyGroupDelegateTarget::class, "className", $delegates[0]->callable);
		$this->assertAttributeEquals("method1", "methodName", $delegates[0]->callable);
		
	}
	
}

?>