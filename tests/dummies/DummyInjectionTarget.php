<?php
namespace intrawarez\slimannotations\tests;

use intrawarez\slimannotations\annotations\Dependency;

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
