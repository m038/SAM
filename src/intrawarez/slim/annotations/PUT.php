<?php

namespace intrawarez\sabertooth\slim\annotations;

/**
 * 
 * @author darjeeling
 * @Annotation
 *
 */
class PUT extends Method implements Annotation {
	
	public function __construct () {
		$this->setName(METHOD::PUT);
	}
	
}

?>