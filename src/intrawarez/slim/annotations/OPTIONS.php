<?php

namespace intrawarez\slim\annotations;

/**
 * 
 * The annotation for OPTIONS handlers.
 * 
 * @author maxmeffert
 * @Annotation
 *
 */
class OPTIONS extends Method implements SlimAnnotation {
	
	public function __construct () {
		$this->setName(METHOD::OPTIONS);
	}
	
}

?>