<?php
namespace intrawarez\slimannotations\delegates;

use Slim\App;
use Interop\Container\ContainerInterface;
use intrawarez\slimannotations\Instantiator;

abstract class AbstractDelegate implements DelegateInterface
{
    private $app;
    private $instantiator;
    
    public function __construct(App $app, Instantiator $instantiator)
    {
        $this->app = $app;
        $this->instantiator = $instantiator;
    }
    
    public function getApp(): App
    {
        return $this->app;
    }
    
    public function getContainer(): ContainerInterface
    {
        return $this->app->getContainer();
    }
    
    public function getInstantiator(): Instantiator
    {
        return $this->instantiator;
    }
}
