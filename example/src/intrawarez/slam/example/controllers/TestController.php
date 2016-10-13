<?php
namespace intrawarez\slam\example\controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use intrawarez\slam\annotations as SLM;
use Interop\Container\ContainerInterface;

/**
 * @SLM\Group(pattern="/")
 *
 * @author maxmeffert
 */
class TestController
{

    /**
     * @SLM\Dependency(id="twig")
     *
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @SLM\GET
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
