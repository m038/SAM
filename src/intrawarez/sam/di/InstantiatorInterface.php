<?php
namespace intrawarez\sam\di;

use intrawarez\sam\metadata\ClassMetadata;

/**
 * @author maxmeffert
 */
interface InstantiatorInterface
{
    /**
     * @param ClassMetadata $classMetadata
     * @return object
     */
    public function createInstance(ClassMetadata $classMetadata);
}
