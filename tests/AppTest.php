<?php
namespace intrawarez\slimannotations\tests;

use PHPUnit\Framework\TestCase;
use intrawarez\slimannotations\annotations\Group;
use intrawarez\slimannotations\annotations\GET;
use intrawarez\slimannotations\annotations\POST;
use intrawarez\slimannotations\annotations\PUT;
use intrawarez\slimannotations\annotations\DELETE;
use intrawarez\slimannotations\CallableResolver;
use intrawarez\slimannotations\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Body;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouteInterface;
use Slim\Interfaces\RouterInterface;

include_once __DIR__."/DummyController.php";

class AppTest extends TestCase
{

    private static function newRouter(): RouterInterface
    {
        $app = new App();
        $app->load(DummyController::class);
        
        return $app->getContainer()->get("router");
    }

    private static function newRequest(): ServerRequestInterface
    {
        return Request::createFromEnvironment(Environment::mock());
    }

    private static function newResponse(): ResponseInterface
    {
        return new Response();
    }

    private function assertRoute(RouteInterface $route, $expectedMethods, $expectedPattern, $expectedContents)
    {
        $this->assertAttributeContains($expectedMethods, "methods", $route);
        $this->assertEquals($expectedPattern, $route->getPattern());
        
        $response = $route->__invoke(self::newRequest(), self::newResponse());
        
        $body = $response->getBody();
        $body->rewind();
        $this->assertEquals($expectedContents, $body->getContents());
    }

    public function testCreate()
    {
        $app = App::create();
        
        $container = $app->getContainer();
        
        $this->assertInstanceOf(CallableResolver::class, $container->get("callableResolver"));
    }

    public function testConstruct()
    {
        $app = new App();
        
        $container = $app->getContainer();
        
        $this->assertInstanceOf(CallableResolver::class, $container->get("callableResolver"));
    }

    public function testGetNamespaces()
    {
        $app = App::create();
        
        $this->assertInternalType("array", $app->getNamespaces());
        $this->assertEquals([], $app->getNamespaces());
        
        $namespaces = [
            "\\intrawarez\\slimannotations\\tests\\" => __DIR__
        ];
        
        $container = [
            "@namespaces" => $namespaces
        ];
        
        $app = App::create($container);
        
        $this->assertInternalType("array", $app->getNamespaces());
        $this->assertEquals($namespaces, $app->getNamespaces());
    }

    public function testLoad()
    {
        $router = self::newRouter();
        
        $route = $router->lookupRoute("route0");
        
        $this->assertRoute($route, "GET", "/dummy", METHOD1);
        
        $route = $router->lookupRoute("route1");
        
        $this->assertRoute($route, "GET", "/dummy/foo", METHOD2);
        
        $route = $router->lookupRoute("route2");
        
        $this->assertRoute($route, "POST", "/dummy", METHOD3);
        
        $route = $router->lookupRoute("route3");
        
        $this->assertRoute($route, "PUT", "/dummy", METHOD4);
        
        $route = $router->lookupRoute("route4");
        
        $this->assertRoute($route, "DELETE", "/dummy", METHOD5);
    }
}
