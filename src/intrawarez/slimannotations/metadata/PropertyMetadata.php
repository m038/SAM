<?php
namespace intrawarez\slimannotations\metadata;

use Doctrine\Common\Annotations\Reader;

final class PropertyMetadata extends AbstractMetadata
{
    
    public function __construct(\ReflectionProperty $reflectionProperty, Reader $reader)
    {
        parent::__construct($reflectionProperty, $reader);
    }
    
    public function isDependency(): bool
    {
        return false;
    }
}