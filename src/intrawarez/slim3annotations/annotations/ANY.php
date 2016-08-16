<?php

namespace intrawarez\slim3annotations\annotations;

/**
 * 
 * The annotation for ANY handlers.
 * 
 * @author maxmeffert
 * @Annotation
 *
 */
class ANY implements SlimAnnotation {
	
	public function __construct () {
		$this->setName(METHOD::ANY);
	}
	
}

?>