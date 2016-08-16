<?php

namespace intrawarez\slim3annotations;

use Interop\Container\ContainerInterface;
use intrawarez\sabertooth\reflection\Reflections;

abstract class AnnotatedController {
	
	/**
	 * 
	 * @param ContainerInterface $container
	 */
	final public function __construct (ContainerInterface $container) {
		
		$rc = Reflections::reflectionClassOf($this);
		
		foreach ($rc->getProperties() as $rp) {
			
			/**
			 * @var \ReflectionProperty $rp
			 */
			
			$id = "";
			
			if ($container->has($id)) {
				
				$rp->setAccessible(true);
				$rp->setValue($this, $container->get($id));
				$rp->setAccessible(false);
				
			}
			
			
		}
		
		$this->init($container);
		
	}
	
	/**
	 * 
	 * @param ContainerInterface $container
	 */
	protected function init (ContainerInterface $container) {}
	
}

?>