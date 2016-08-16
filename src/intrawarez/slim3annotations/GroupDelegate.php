<?php

namespace intrawarez\slim3annotations;

use Interop\Container\ContainerInterface;
use intrawarez\slim3annotations\annotations\Method;

class GroupDelegate extends AbstractDelegate implements DelegateInterface {
	
	private $className;
	
	public function __construct (string $className) {
		
		$this->className = $className;
		
	}
	
	public function getCallable(ContainerInterface $container) : callable {
		
		$className = $this->className;
		
		return function () use ($className) {
			
			/**
			 * @var \Slim\App $app;
			 */
			$app = $this;
						
			$class = new \ReflectionClass($className);
			
			foreach ($class->getMethods(\ReflectionMethod::IS_PUBLIC) as $rm) {
				
				/**
				 * @var \ReflectionMethod $rm
				 */
				
				$method = GroupDelegate::AnnotationReader()->getMethodAnnotation($rm, Method::class);
								
				if ($method instanceof Method) {
					
					$pattern = $method->pattern;
					
					$callback = new GroupMethodDelegate($className, $rm->getName());
					
					switch ($method->getName()) {
						
						case Method::GET:
							$app->get($pattern, $callback);
							break;
							
						case Method::POST:
							$app->post($pattern, $callback);
						
					}
					
				}
				
			}
			
		};
		
	}
	
}

?>