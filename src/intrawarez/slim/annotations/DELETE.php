<?php

namespace intrawarez\slim\annotations;

/**
 * 
 * The annotation for DELETE handlers.
 * 
 * @author maxmeffert
 * @Annotation
 *
 */
class DELETE extends Method implements SlimAnnotation {
	
	public function __construct () {
		$this->setName(METHOD::DELETE);
	}
	
}

?>