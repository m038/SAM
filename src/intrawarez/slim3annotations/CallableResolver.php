<?php

namespace intrawarez\slim3annotations;


use Slim\Interfaces\CallableResolverInterface;
use Interop\Container\ContainerInterface;

/**
 * Implementation of CallableResolverInterface for delegates.
 * 
 * Falls back to \Slim\CallableResolver.
 * 
 * @author maxmeffert
 *
 */
class CallableResolver implements CallableResolverInterface {
	
	/**
	 * The container.
	 * @var ContainerInterface
	 */
	private $container;
	
	/**
	 * The default callable resolver.
	 * @var CallableResolverInterface
	 */
	private $defaultResolver;
	
	/**
	 * Constructs a new callable resolver with a given container.
	 * 
	 * @param ContainerInterface $container The given container.
	 */
	public function __construct (ContainerInterface $container) {
		
		$this->container = $container;
		
		$this->defaultResolver = new \Slim\CallableResolver($container);
		
	}
	
	/**
	 * Resolves a given value to a callable.
	 * 
	 * If the value is an instance of DelegateInterface, it uses the DelegateInterface::getCallable() methods,
	 * otherwise \Slim\CallableResolver is used.
	 * 
	 * @see \Slim\Interfaces\CallableResolverInterface::resolve()
	 * 
	 * @return callable
	 */
	public function resolve ($toResolve) {
		
		if ($toResolve instanceof DelegateInterface) {
			
			return $toResolve->getCallable($this->container);
			
		}
		
		return $this->defaultResolver->resolve($toResolve);
		
		
	}
	
}

?>