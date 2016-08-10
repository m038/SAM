<?php

namespace intrawarez\slim\annotations;

/**
 * 
 * @author darjeeling
 * @Annotation
 *
 */
class ANY implements Annotation {
	
	public function __construct () {
		$this->setName(METHOD::ANY);
	}
	
}

?>