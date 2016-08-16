<?php

namespace intrawarez\slim\annotations\example\controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
	public function onGet (ServerRequestInterface $req, ResponseInterface $res, array $args) {
		
		$res->getBody()->write("it worksssss");
		
		return $res;
		
	}
	
}


?>