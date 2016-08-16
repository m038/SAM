<?php

namespace intrawarez\slim3annotations\annotations;

/**
 * 
 * The base class for HTTP method annotation handlers.
 * 
 * @author maxmeffert
 *
 */
abstract class Method implements Annotation {
	
	const GET = "GET";
	const POST = "POST";
	const PUT = "PUT";
	const DELETE = "DELETE";
	const OPTIONS = "OPTIONS";
	const ANY = "ANY";
	
	private $name = Method::ANY;
	public $pattern = "";
	
	final public function getName () {
		return $this->name;
	}
	
	final protected function setName ($name) {
		$this->name = $name;
	}
	
}

?>