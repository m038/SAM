<?php
namespace intrawarez\slimannotations\tests;

use PHPUnit\Framework\TestCase;
use intrawarez\slimannotations\GroupDelegate;
use intrawarez\slimannotations\annotations\GET;
use intrawarez\slimannotations\App;
use intrawarez\slimannotations\GroupMethodDelegate;
use Slim\Container;

include_once __DIR__."/MockApp.php";
include_once __DIR__."/DummyGroupDelegateTarget.php";

class GroupDelegateTest extends TestCase
{

    public function test()
    {
        $delegate = new GroupDelegate(DummyGroupDelegateTarget::class);
        
        /**
         *
         * @var Closure $callable
         */
        $callable = $delegate->getCallable(new Container());
        
        $this->assertInstanceOf(\Closure::class, $callable);
        
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
