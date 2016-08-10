<?php

namespace intrawarez\sabertooth\slim\annotations;

/**
 * 
 * @author darjeeling
 * @Annotation
 *
 */
class DELETE extends Method implements Annotation {
	
	public function __construct () {
		$this->setName(METHOD::DELETE);
	}
	
}

?>