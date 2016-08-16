<?php

namespace intrawarez\slim3annotations\annotations;

/**
 * 
 * The annotation for POST handlers.
 * 
 * @author maxmeffert
 * @Annotation
 *
 */
class POST extends Method implements SlimAnnotation {

	public function __construct () {
		$this->setName(METHOD::POST);
	}
	
}

?>