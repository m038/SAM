<?php
namespace intrawarez\sam\example\controllers;

use intrawarez\sam\annotations as SAM;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @SAM\Group(pattern="/")
 *
 * @author maxmeffert
 */
class TestController
{
    /**
     * @SAM\Dependency(id="twig")
     *
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @SAM\GET
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
