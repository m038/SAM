<?php

namespace intrawarez\slim3annotations\annotations;

/**
 * 
 * The annotation for PUT handlers.
 * 
 * @author maxmeffert
 * @Annotation
 *
 */
class PUT extends Method implements SlimAnnotation {
	
	public function __construct () {
		$this->setName(METHOD::PUT);
	}
	
}

?>