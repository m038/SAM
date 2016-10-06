<?php
namespace intrawarez\slimannotations\example\controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use intrawarez\slim3annotations\annotations\Group;
use intrawarez\slim3annotations\annotations\GET;
use intrawarez\slim3annotations\annotations\Dependency;
use Interop\Container\ContainerInterface;

/**
 * @Group(pattern="/")
 *
 * @author maxmeffert
 */
class TestController
{

    /**
     * @Dependency(id="twig")
     *
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @GET
     *
     * @param ServerRequestInterface $req
     * @param ResponseInterface $res
     * @param array $args
     */
    public function fii(ServerRequestInterface $req, ResponseInterface $res, array $args)
    {
        // var_dump($this->twig);
        // throw new \Exception("lala");
        $twig = $this->twig;
        
        $res->getBody()->write($twig->render("index.twig", [
            "hello" => "World"
        ]));
        
        return $res;
    }
}
