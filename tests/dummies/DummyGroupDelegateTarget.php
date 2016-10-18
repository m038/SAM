<?php
namespace intrawarez\sam\tests;

use intrawarez\sam\annotations\GET;

class DummyGroupDelegateTarget
{

    /**
     * @GET
     */
    public function method1()
    {
    }

    /**
     * @GET
     */
    public function method2()
    {
    }
}
