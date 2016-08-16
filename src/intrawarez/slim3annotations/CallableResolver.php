<?php

namespace intrawarez\slim3annotations;


use Slim\Interfaces\CallableResolverInterface;
use Interop\Container\ContainerInterface;

class CallableResolver implements CallableResolverInterface {
	
	/**
	 * 
	 * @var ContainerInterface
	 */
	private $container;
	
	/**
	 * 
	 * @var CallableResolverInterface
	 */
	private $defaultResolver;
	
	public function __construct (ContainerInterface $container) {
		
		$this->container = $container;
		
		$this->defaultResolver = new \Slim\CallableResolver($container);
		
	}
	
	
	
	public function resolve($toResolve) {
		
		if ($toResolve instanceof DelegateInterface) {
			
			return $toResolve->getCallable($this->container);
			
		}
		
		return $this->defaultResolver->resolve($toResolve);
		
		
	}
	
}

?>