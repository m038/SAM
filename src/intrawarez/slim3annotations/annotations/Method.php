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
	
	public $pattern = "";
	
}

?>