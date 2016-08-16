<?php

namespace intrawarez\slim3annotations\annotations;

/**
 * 
 * The annotation for GET handlers.
 * 
 * @author maxmeffert
 * @Annotation
 *
 */
class GET extends Method implements Annotation {
	
	public function __construct () {
		$this->setName(METHOD::GET);
	}
	
}

?>