<?php

namespace intrawarez\slim\annotations;

/**
 * 
 * @author darjeeling
 * @Annotation
 *
 */
class OPTIONS extends Method implements Annotation {
	
	public function __construct () {
		$this->setName(METHOD::OPTIONS);
	}
	
}

?>