<?php
namespace intrawarez\slam\tests;

use intrawarez\slam\annotations\GET;

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
