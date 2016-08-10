<?php

namespace intrawarez\sabertooth\slim\annotations;

/**
 * 
 * @author darjeeling
 *
 */
abstract class Method implements Annotation {
	
	const GET = "GET";
	const POST = "POST";
	const PUT = "PUT";
	const DELETE = "DELETE";
	const OPTIONS = "OPTIONS";
	const ANY = "ANY";
	
	private $name;
	
	final public function getName () {
		return $this->name;
	}
	
	final protected function setName ($name) {
		$this->name = $name;
	}
	
}

?>