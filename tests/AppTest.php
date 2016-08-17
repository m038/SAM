<?php

use PHPUnit\Framework\TestCase;

use intrawarez\slim3annotations\annotations\Group;
use intrawarez\slim3annotations\annotations\GET;
use intrawarez\slim3annotations\App;
use Slim\Interfaces\RouteGroupInterface;
use Slim\Interfaces\RouteInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Environment;
use Slim\Http\Response;

/**
 * 
 * @Group(pattern="/dummy");
 *
 */
class DummyController {
	
	/**
	 * @GET
	 */
	public function method1 (ServerRequestInterface $req, ResponseInterface $res, array $args) : ResponseInterface {
		
		return $res->withStatus(200);
		
	}
	
	/**
	 * @GET(pattern="/foo")
	 */
	public function method2 (ServerRequestInterface $req, ResponseInterface $res, array $args) : ResponseInterface {
		

		return $res->withStatus(404);
		
	}
	
}

class AppTest extends TestCase {
	
	public function testLoad () {
		
		$app = new App();
		
		$group = $app->load(DummyController::class);
		
		$this->assertInstanceOf(RouteGroupInterface::class, $group);
		

		$request = Request::createFromEnvironment(Environment::mock());
		$response = new Response();
		
		/**
		 * 
		 * @var \Slim\Router $router
		 */
		$router = $app->getContainer()->get("router");
		
		// rotue0 -> method1
		
		$route = $router->lookupRoute("route0");
		$response = $route->__invoke($request, $response);
		
		$this->assertInstanceOf(RouteInterface::class, $route);
		$this->assertAttributeContains("GET", "methods", $route);
		$this->assertEquals("/dummy", $route->getPattern());
		$this->assertEquals(200, $response->getStatusCode());
		
		// route1 -> method2
		
		$route = $router->lookupRoute("route1");
		$response = $route->__invoke($request, $response);
		
		$this->assertInstanceOf(RouteInterface::class, $route);
		$this->assertAttributeContains("GET", "methods", $route);
		$this->assertEquals("/dummy/foo", $route->getPattern());
		$this->assertEquals(404, $response->getStatusCode());
		
	}
	
}

?>