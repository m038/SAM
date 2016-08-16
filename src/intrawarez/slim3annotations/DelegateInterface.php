<?php

namespace intrawarez\slim3annotations;

use Interop\Container\ContainerInterface;

interface DelegateInterface {
	
	public function getCallable (ContainerInterface $container) : callable;
	
}

?>