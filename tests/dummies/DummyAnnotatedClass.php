<?php
namespace intrawarez\sam\tests;

use intrawarez\sam\annotations\Group;
use intrawarez\sam\annotations\Middleware;
use intrawarez\sam\annotations\Dependency;
use intrawarez\sam\annotations\Action;
use intrawarez\sam\annotations\GET;
use intrawarez\sam\annotations\Annotations;

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
