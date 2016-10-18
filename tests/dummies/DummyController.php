<?php
namespace intrawarez\sam\tests;

use intrawarez\sam\annotations\Group;
use intrawarez\sam\annotations\GET;
use intrawarez\sam\annotations\POST;
use intrawarez\sam\annotations\PUT;
use intrawarez\sam\annotations\DELETE;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

const METHOD1 = 661;

const METHOD2 = 662;

const METHOD3 = 663;

const METHOD4 = 664;

const METHOD5 = 665;

/**
 * @Group(pattern="/dummy");
 */
class DummyController
{

    /**
     * @GET
     */
    public function method1(ServerRequestInterface $req, ResponseInterface $res, array $args): ResponseInterface
    {
        $res->getBody()->write(METHOD1);

        return $res;
    }

    /**
     * @GET(pattern="/foo")
     */
    public function method2(ServerRequestInterface $req, ResponseInterface $res, array $args): ResponseInterface
    {
        $res->getBody()->write(METHOD2);

        return $res;
    }

    /**
     * @POST
     */
    public function method3(ServerRequestInterface $req, ResponseInterface $res, array $args): ResponseInterface
    {
        $res->getBody()->write(METHOD3);

        return $res;
    }

    /**
     * @PUT
     */
    public function method4(ServerRequestInterface $req, ResponseInterface $res, array $args): ResponseInterface
    {
        $res->getBody()->write(METHOD4);

        return $res;
    }

    /**
     * @DELETE
     */
    public function method5(ServerRequestInterface $req, ResponseInterface $res, array $args): ResponseInterface
    {
        $res->getBody()->write(METHOD5);

        return $res;
    }
}
