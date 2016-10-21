<?php
namespace intrawarez\sam\example\controllers;

use intrawarez\sam\annotations as SAM;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @SAM\GET(pattern="/action")
 *
 * @author maxmeffert
 */
class ActionController
{
    /**
     * @SAM\Dependency(id="twig")
     *
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param ServerRequestInterface $req
     * @param ResponseInterface $res
     * @param array $args
     */
    public function __invoke(ServerRequestInterface $req, ResponseInterface $res, array $args)
    {
        $res->getBody()->write($this->twig->render("hello.twig", [
            "hello" => __CLASS__
        ]));
        
        return $res;
    }
}
