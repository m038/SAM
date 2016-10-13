<?php
namespace intrawarez\slam\tests;

use intrawarez\slam\annotations\Dependency;

class DummyInjectionTarget
{

    /**
     * @Dependency(id="dep1")
     *
     * @var DummyDependency
     */
    private $dependency1;

    /**
     * @Dependency(id="dep1")
     *
     * @var DummyDependency
     */
    private $dependency2;
}
