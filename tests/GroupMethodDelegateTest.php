<?php
namespace intrawarez\slimannotations\tests;

use PHPUnit\Framework\TestCase;
use intrawarez\slimannotations\delegates\GroupActionDelegate;
use Slim\Container;

class GroupMethodDelegateTest extends TestCase
{

    public function testGetCallable()
    {
        $className = GroupMethodDelegateTest::class;
        $methodName = "testGetCallable";
        
        $delegate = new GroupActionDelegate($className, $methodName);
        
        $callable = $delegate->getCallable(new Container());
        
        $this->assertInstanceOf(\Closure::class, $callable);
        
        $className = GroupActionDelegate::class;
        $methodName = "foo";
        
        $delegate = new GroupActionDelegate($className, $methodName);
        
        $this->expectException(\Exception::class);
        $callable = $delegate->getCallable(new Container());
    }
}
