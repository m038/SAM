<?php
namespace intrawarez\slimannotations\tests;

use intrawarez\slimannotations\annotations\Group;
use intrawarez\slimannotations\annotations\Middleware;
use intrawarez\slimannotations\annotations\Dependency;
use intrawarez\slimannotations\annotations\HttpMethod;
use intrawarez\slimannotations\annotations\GET;
use intrawarez\slimannotations\annotations\Annotations;

/**
 * @Group(pattern="/dummy")
 * @Middleware(name="Middleware1")
 * @Middleware(name="Middleware2")
 */
class DummyAnnotatedClass
{

    /**
     * @Dependency(id="dep")
     *
     * @var unknown
     */
    private $property;

    /**
     * @GET
     * @Middleware(name="Middleware3")
     * @Middleware(name="Middleware4")
     */
    public function method()
    {
    }
}
