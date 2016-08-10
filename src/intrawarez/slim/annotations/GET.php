<?php

namespace intrawarez\slim\annotations;

/**
 * 
 * The annotation for GET handlers.
 * 
 * @author maxmeffert
 * @Annotation
 *
 */
class GET extends Method implements SlimAnnotation {
	
	public function __construct () {
		$this->setName(METHOD::GET);
	}
	
}

?>