<?php
namespace intrawarez\slimannotations\metadata;

use Doctrine\Common\Annotations\Reader;

final class MethodMetadata extends AbstractMetadata
{
    
    public function __construct(\ReflectionMethod $reflectionMethod, Reader $reader)
    {
        parent::__construct($reflectionMethod, $reader);
    }
    
}