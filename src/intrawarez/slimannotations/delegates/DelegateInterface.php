<?php
namespace intrawarez\slimannotations\delegates;

use Interop\Container\ContainerInterface;

/**
 * Interface for delegates.
 *
 * @author maxmeffert
 *
 */
interface DelegateInterface
{

    /**
     * Gets the callable.
     * @param ContainerInterface $container
     * @return callable
     */
    public function getCallable(ContainerInterface $container): callable;
}
