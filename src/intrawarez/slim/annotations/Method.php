<?php

namespace intrawarez\slim\annotations;

/**
 * 
 * The base class for HTTP method annotation handlers.
 * 
 * @author maxmeffert
 *
 */
abstract class Method implements SlimAnnotation {
	
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