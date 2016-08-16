<?php

namespace intrawarez\slim3annotations\annotations;

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