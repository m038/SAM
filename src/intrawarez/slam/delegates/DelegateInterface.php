<?php
namespace intrawarez\slam\delegates;

use Interop\Container\ContainerInterface;
use Slim\App;
use intrawarez\slam\Instantiator;

/**
 * Interface for delegates.
 *
 * @author maxmeffert
 *
 */
interface DelegateInterface
{

    public function getApp(): App;
    public function getContainer(): ContainerInterface;
    public function getInstantiator(): Instantiator;
    public function __invoke();
}
