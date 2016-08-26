<?php

namespace intrawarez\slimannotations;

use Interop\Container\ContainerInterface;

/**
 * Interface for delegates.
 * 
 * @author maxmeffert
 *
 */
interface DelegateInterface {
	
	/**
	 * 
	 * @param ContainerInterface $container
	 * @return callable
	 */
	public function getCallable (ContainerInterface $container) : callable;
	
}

?>