<?php
namespace intrawarez\sam\delegates;

use Interop\Container\ContainerInterface;
use intrawarez\sam\annotations\Action;
use intrawarez\sam\annotations\Group;
use intrawarez\sam\di\Instantiator;
use Slim\App;
use Slim\Routable;

/**
 * @author maxmeffert
 */
interface DelegateMapperInterface
{
    /**
     * @return App
     */
    public function getApp(): App;
    
    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface;
    
    /**
     * @return Instantiator
     */
    public function getInstantiator(): Instantiator;
    
    /**
     * @param Group $group
     * @param DelegateInterface $callable
     * @return Routable
     */
    public function group(Group $group, DelegateInterface $callable): Routable;
    
    /**
     * @param Action $action
     * @param DelegateInterface $callable
     * @return Routable
     */
    public function action(Action $action, DelegateInterface $callable): Routable;
}
