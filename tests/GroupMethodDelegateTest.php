<?php
namespace intrawarez\slimannotations\tests;

use PHPUnit\Framework\TestCase;
use intrawarez\slimannotations\delegates\GroupMethodDelegate;
use Slim\Container;

class GroupMethodDelegateTest extends TestCase
{

    public function testGetCallable()
    {
        $className = GroupMethodDelegateTest::class;
        $methodName = "testGetCallable";
        
        $delegate = new GroupMethodDelegate($className, $methodName);
        
        $callable = $delegate->getCallable(new Container());
        
        $this->assertInstanceOf(\Closure::class, $callable);
        
        $className = GroupMethodDelegate::class;
        $methodName = "foo";
        
        $delegate = new GroupMethodDelegate($className, $methodName);
        
        $this->expectException(\Exception::class);
        $callable = $delegate->getCallable(new Container());
    }
}
