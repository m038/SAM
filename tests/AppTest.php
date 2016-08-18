<?php

use PHPUnit\Framework\TestCase;

use intrawarez\slim3annotations\annotations\Group;
use intrawarez\slim3annotations\annotations\GET;
use intrawarez\slim3annotations\annotations\POST;
use intrawarez\slim3annotations\annotations\PUT;
use intrawarez\slim3annotations\annotations\DELETE;
use intrawarez\slim3annotations\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Body;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouteInterface;
use Slim\Interfaces\RouterInterface;

const METHOD1 = 661;
const METHOD2 = 662;
const METHOD3 = 663;
const METHOD4 = 664;
const METHOD5 = 665;

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
		
		$res->getBody()->write(METHOD1);
				
		return $res;
		
	}
	
	/**
	 * @GET(pattern="/foo")
	 */
	public function method2 (ServerRequestInterface $req, ResponseInterface $res, array $args) : ResponseInterface {
		

		$res->getBody()->write(METHOD2);
		
		return $res;
		
	}
	
	/**
	 * @POST
	 */
	public function method3 (ServerRequestInterface $req, ResponseInterface $res, array $args) : ResponseInterface {
		

		$res->getBody()->write(METHOD3);
		
		return $res;
		
	}
	
	/**
	 * @PUT
	 */
	public function method4 (ServerRequestInterface $req, ResponseInterface $res, array $args) : ResponseInterface {
		

		$res->getBody()->write(METHOD4);
		
		return $res;
		
	}
	
	/**
	 * @DELETE
	 */
	public function method5 (ServerRequestInterface $req, ResponseInterface $res, array $args) : ResponseInterface {
		

		$res->getBody()->write(METHOD5);
		
		return $res;
		
	}
	
}

class AppTest extends TestCase {
	
	static private function newAppRouter () : RouterInterface {
		
		$app = new App();
		$app->load(DummyController::class);
		
		return $app->getContainer()->get("router");
		
	}
	
	static private function newRequest () : ServerRequestInterface {
		
		return Request::createFromEnvironment(Environment::mock());
		
	}
	
	static private function newResponse () : ResponseInterface {
		
		return new Response();
		
	}
	
	private function assertRoute (RouteInterface $route, $expectedMethods, $expectedPattern, $expectedContents) {
		
		$this->assertAttributeContains($expectedMethods, "methods", $route);
		$this->assertEquals($expectedPattern, $route->getPattern());
		
		$response = $route->__invoke(self::newRequest(), self::newResponse());
		
		$body = $response->getBody();
		$body->rewind();
		$this->assertEquals($expectedContents, $body->getContents());
		
	}
	
	public function testMethod1 () {
		
		$router = self::newAppRouter();
		
		$route = $router->lookupRoute("route0");
		
		$this->assertRoute($route, "GET", "/dummy", METHOD1);
		
	}
	
	public function testMethod2 () {
		
		$router = self::newAppRouter();
		
		$route = $router->lookupRoute("route1");
		
		$this->assertRoute($route, "GET", "/dummy/foo", METHOD2);
		
	}
	
	public function testMethod3 () {
		
		$router = self::newAppRouter();
		
		$route = $router->lookupRoute("route2");
		
		$this->assertRoute($route, "POST", "/dummy", METHOD3);
		
	}
	
	public function testMethod4 () {
		
		$router = self::newAppRouter();
		
		$route = $router->lookupRoute("route3");
		
		$this->assertRoute($route, "PUT", "/dummy", METHOD4);
		
	}
	
	public function testMethod5 () {
		
		$router = self::newAppRouter();
		
		$route = $router->lookupRoute("route4");
		
		$this->assertRoute($route, "DELETE", "/dummy", METHOD5);
		
	}
	
}

?>