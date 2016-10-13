<?php
namespace intrawarez\slam\annotations;

/**
 * The annotation for slim groups
 *
 * @author maxmeffert
 * @Annotation
 */
class Group implements SlimAnnotation
{
    private $pattern;
    
    public function __construct(array $arguments = [])
    {
        $this->pattern = strval($arguments["pattern"]);
    }
    
    public function getPattern(): string
    {
        return $this->pattern;
    }
}
