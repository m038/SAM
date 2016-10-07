<?php
namespace intrawarez\slimannotations\annotations;

/**
 * The annotation for a middleware.
 *
 * @author maxmeffert
 * @Annotation
 */
class Middleware implements SlimAnnotation
{

    public $name;
    
    public $class;
    public $callable;
    
    public function isClass(): bool
    {
        return isset($this->class);
    }
}
