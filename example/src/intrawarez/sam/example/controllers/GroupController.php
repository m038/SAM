<?php
namespace intrawarez\sam\example\controllers;

use intrawarez\sam\annotations as SAM;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @SAM\Group(pattern="")
 *
 * @author maxmeffert
 */
class GroupController
{
    /**
     * @SAM\Dependency(id="twig")
     *
     * @var \Twig_Environment
     */
    private $twig;
    
    /**
     * @SAM\GET(pattern="/")
     *
     * @param ServerRequestInterface $req
     * @param ResponseInterface $res
     * @param array $args
     */
    public function showIndex(ServerRequestInterface $req, ResponseInterface $res, array $args): ResponseInterface
    {
        $res->getBody()->write($this->twig->render("index.twig"));
        
        return $res;
    }

    /**
     * @SAM\GET(pattern="/group")
     *
     * @param ServerRequestInterface $req
     * @param ResponseInterface $res
     * @param array $args
     */
    public function doAction(ServerRequestInterface $req, ResponseInterface $res, array $args): ResponseInterface
    {
        $res->getBody()->write($this->twig->render("hello.twig", [
            "hello" =>  __CLASS__
        ]));
        
        return $res;
    }
}
