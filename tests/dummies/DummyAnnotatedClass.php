<?php
namespace intrawarez\slam\tests;

use intrawarez\slam\annotations\Group;
use intrawarez\slam\annotations\Middleware;
use intrawarez\slam\annotations\Dependency;
use intrawarez\slam\annotations\Action;
use intrawarez\slam\annotations\GET;
use intrawarez\slam\annotations\Annotations;

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
