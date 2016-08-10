<?php

namespace intrawarez\slim\annotations;

/**
 * 
 * @author darjeeling
 * @Annotation
 *
 */
class GET extends Method implements Annotation {
	
	public function __construct () {
		$this->setName(METHOD::GET);
	}
	
}

?>