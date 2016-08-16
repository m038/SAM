<?php

namespace intrawarez\slim3annotations\example\controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use intrawarez\slim3annotations\annotations\Route;
use intrawarez\slim3annotations\annotations\GET;
use Interop\Container\ContainerInterface;

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
	 * @var \Twig_Environment
	 */
	private $twig;
	
	public function __construct (ContainerInterface $container) {
		
		$this->twig = $container->get("twig");
		
	}
	
	/**
	 * 
	 * @param unknown $req
	 * @param unknown $res
	 * @param array $args
	 * 
	 * @GET
	 */
	public function onGet (ServerRequestInterface $req, ResponseInterface $res, array $args) {
		
		$twig = $this->twig;
	
		$res->getBody()->write($twig->render("index.twig",[
				"name" => "Homer Simpson"
		]));
		
		return $res;
		
	}
	
}


?>