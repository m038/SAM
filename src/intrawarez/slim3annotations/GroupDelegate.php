<?php

namespace intrawarez\slim3annotations;

use Interop\Container\ContainerInterface;
use intrawarez\slim3annotations\annotations\Method;
use intrawarez\slim3annotations\annotations\GET;
use intrawarez\slim3annotations\annotations\POST;
use intrawarez\slim3annotations\annotations\PUT;
use intrawarez\slim3annotations\annotations\DELETE;
use intrawarez\slim3annotations\annotations\OPTIONS;
use intrawarez\slim3annotations\annotations\ANY;
use intrawarez\slim3annotations\annotations\Annotations;

/**
 * Delegate implementation for Slim groups.
 * 
 * @author maxmeffert
 *
 */
class GroupDelegate implements DelegateInterface {
	
	/**
	 * 
	 * @var string
	 */
	private $className;

	/**
	 * 
	 * @param string $className
	 */
	public function __construct (string $className) {
		
		$this->className = $className;
		
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \intrawarez\slim3annotations\DelegateInterface::getCallable()
	 */
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
				
								
				$method = Annotations::Method($rm);
				
				if ($method->isPresent()) {
					
					/**
					 * 
					 * @var Method $method
					 */
					
					$method = $method->get();
					
					$pattern = $method->pattern;
					
					$callback = new GroupMethodDelegate($className, $rm->getName());
					
					if ($method instanceof GET) {
						
						$app->get($pattern, $callback);
						
					}
					elseif ($method instanceof POST) {
						
						$app->post($pattern, $callback);
						
					}
					elseif ($method instanceof PUT) {
						
						$app->put($pattern, $callback);
						
					}
					elseif ($method instanceof DELETE) {
						
						$app->delete($pattern, $callback);
						
					}
					elseif ($method instanceof OPTIONS) {
						
						$app->options($pattern, $callback);
						
					}
					elseif ($method instanceof ANY) {
						
						$app->any($pattern, $callback);
						
					}
					
										
				}
				
			}
			
		};
		
	}
	
}

?>