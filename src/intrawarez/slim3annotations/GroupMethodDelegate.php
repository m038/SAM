<?php

namespace intrawarez\slim3annotations;

use Interop\Container\ContainerInterface;

class GroupMethodDelegate extends AbstractDelegate implements DelegateInterface {
	
	private $className;
	private $methodName;
	
	public function __construct(string $className, string $methodName) {
	
		$this->className = $className;
		$this->methodName = $methodName;
		
	}
	
	public function getCallable(ContainerInterface $container) : callable {
		
		$class = new \ReflectionClass($this->className);
		
		if ($class->hasMethod($this->methodName)) {
			
			return $class->getMethod($this->methodName)->getClosure(self::newInstance($class, $container));
			
		}
		
		throw new \Exception("Class {$this->className} has no method {$this->methodName}!");
		
	}
	
}

?>