<?php
namespace intrawarez\slimannotations\tests;

use intrawarez\slimannotations\App;

include_once __DIR__."/MockAppDelegateRecord.php";

class MockApp extends App
{

    private $delegates = [];

    public function getDelegates()
    {
        return $this->delegates;
    }

    private function addDelegate($method, $pattern, $callable)
    {
        $delegate = new MockAppDelegateRecord();
        $delegate->method = $method;
        $delegate->pattern = $pattern;
        $delegate->callable = $callable;

        array_push($this->delegates, $delegate);
    }

    public function get($pattern, $callable)
    {
        $this->addDelegate("get", $pattern, $callable);

        return parent::get($pattern, $callable);
    }

    public function post($pattern, $callable)
    {
        $this->addDelegate("post", $pattern, $callable);

        return parent::post($pattern, $callable);
    }

    public function put($pattern, $callable)
    {
        $this->addDelegate("put", $pattern, $callable);

        return parent::put($pattern, $callable);
    }

    public function delete($pattern, $callable)
    {
        $this->addDelegate("delete", $pattern, $callable);

        return parent::delete($pattern, $callable);
    }

    public function options($pattern, $callable)
    {
        $this->addDelegate("options", $pattern, $callable);

        return parent::options($pattern, $callable);
    }

    public function patch($pattern, $callable)
    {
        $this->addDelegate("patch", $pattern, $callable);

        return parent::patch($pattern, $callable);
    }

    public function any($pattern, $callable)
    {
        $this->addDelegate("any", $pattern, $callable);

        return parent::any($pattern, $callable);
    }
}
