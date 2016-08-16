<?php

namespace intrawarez\slim3annotations;

use Interop\Container\ContainerInterface;

abstract class AnnotatedController {
	
	/**
	 * 
	 * @param ContainerInterface $container
	 */
	final public function __construct (ContainerInterface $container) {
		
		
		$this->init($container);
		
	}
	
	/**
	 * 
	 * @param ContainerInterface $container
	 */
	protected function init (ContainerInterface $container) {}
	
}

?>