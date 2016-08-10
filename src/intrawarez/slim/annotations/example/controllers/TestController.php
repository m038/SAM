<?php

namespace intrawarez\slim\annotations\example\controllers;

use intrawarez\slim\annotations\Route;
use intrawarez\slim\annotations\GET;

/**
 * 
 * @author maxmeffert
 * 
 * @Route(pattern="")
 * 
 */
class TestController {
	
	/**
	 * 
	 * @param unknown $req
	 * @param unknown $res
	 * @param array $args
	 * 
	 * @GET
	 */
	public function onGet ($req, $res, array $args) {
		
		echo "it works";
		
	}
	
}


?>