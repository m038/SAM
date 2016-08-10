<?php

namespace intrawarez\slim\annotations;

/**
 * @Annotation
 * @author darjeeling
 *
 */
class POST extends Method implements Annotation {

	public function __construct () {
		$this->setName(METHOD::POST);
	}
	
}

?>