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

    private $name;
    
    public function __construct(array $arguments = [])
    {
        $this->name = strval($arguments["name"]);
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function isClass(): bool
    {
        return class_exists($this->getName());
    }
    
    public function isCallback()
    {
        return function_exists($this->getName());
    }
}
