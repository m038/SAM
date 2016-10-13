<?php
namespace intrawarez\slam\annotations;

/**
 * The base class for HTTP method annotation handlers.
 *
 * @author maxmeffert
 */
abstract class Action implements SlimAnnotation
{
    private $pattern;
    
    public function __construct(array $arguments = [])
    {
        $this->pattern = strval(@$arguments["pattern"]);
    }
    
    public function getPattern(): string
    {
        return $this->pattern;
    }
}
