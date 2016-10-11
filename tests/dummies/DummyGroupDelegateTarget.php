<?php
namespace intrawarez\slimannotations\tests;

use intrawarez\slimannotations\annotations\GET;

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
