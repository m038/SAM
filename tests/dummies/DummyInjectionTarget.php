<?php
namespace intrawarez\sam\tests;

use intrawarez\sam\annotations\Dependency;

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
