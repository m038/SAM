<?php
namespace intrawarez\sam\delegates;

use Interop\Container\ContainerInterface;
use intrawarez\sam\annotations\Action;
use intrawarez\sam\annotations\ANY;
use intrawarez\sam\annotations\DELETE;
use intrawarez\sam\annotations\GET;
use intrawarez\sam\annotations\Group;
use intrawarez\sam\annotations\Middleware;
use intrawarez\sam\annotations\OPTIONS;
use intrawarez\sam\annotations\PATCH;
use intrawarez\sam\annotations\POST;
use intrawarez\sam\annotations\PUT;
use intrawarez\sam\delegates\ActionDelegate;
use intrawarez\sam\delegates\DelegateInterface;
use intrawarez\sam\delegates\GroupDelegate;
use intrawarez\sam\di\Instantiator;
use intrawarez\sam\metadata\ClassMetadata;
use Slim\App;
use Slim\Routable;

class DelegateMapper implements DelegateMapperInterface
{
    /**
     * @var App
     */
    private $app;
    
    /**
     * @var Instantiator
     */
    private $instantiator;
    
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->instantiator = new Instantiator($app->getContainer());
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
    
    public function map(ClassMetadata $classMetadata)
    {
        if ($classMetadata->isGroupDeclaration()) {
            $group = $classMetadata->getGroupDeclaration();
            $callable = new GroupDelegate($this, $classMetadata);
            $this->group($group, $callable);
        }
        
        if ($classMetadata->isActionDeclaration()) {
            $action = $classMetadata->getActionDeclaration();
            $callable = new ActionDelegate($this, $classMetadata);
            $this->action($action, $callable);
        }
    }
    
    public function group(Group $group, DelegateInterface $callable): Routable {
        $pattern = $group->getPattern();
        return $this->app->group($pattern, $callable);
    }
    
    public function action(Action $action, DelegateInterface $callable): Routable {
        $pattern = $action->getPattern();
        
        if ($action instanceof GET) {
            return $this->app->get($pattern, $callable);
        } elseif ($action instanceof POST) {
            return $this->app->post($pattern, $callable);
        } elseif ($action instanceof PUT) {
            return $this->app->put($pattern, $callable);
        } elseif ($action instanceof DELETE) {
            return $this->app->delete($pattern, $callable);
        } elseif ($action instanceof PATCH) {
            return $this->app->patch($pattern, $callable);
        } elseif ($action instanceof OPTIONS) {
            return $this->app->options($pattern, $callable);
        } elseif ($action instanceof ANY) {
            return $this->app->any($pattern, $callable);
        }
        
        return $this->app->map([], $pattern, $callable);
    }
    
    public function middleware(Middleware $middleware, Routable $routable): Routable
    {
        if ($this->getContainer()->has($middleware->getId())) {
            return $routable->add($this->getContainer()->get($middleware->getId()));
        }
        return $routable;
    }
}
