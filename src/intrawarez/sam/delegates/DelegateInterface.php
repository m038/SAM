<?php
namespace intrawarez\sam\delegates;

use Interop\Container\ContainerInterface;
use Slim\App;
use intrawarez\sam\Instantiator;

/**
 * Interface for delegates.
 *
 * @author maxmeffert
 *
 */
interface DelegateInterface
{

    public function getMapper(): DelegateMapperInterface;
    public function __invoke();
}
