<?php
namespace intrawarez\slam\annotations;

/**
 * The annotation for route patterns.
 *
 * @author maxmeffert
 * @Annotation
 */
class Dependency implements SlimAnnotation
{
    private $id;
    
    public function __construct(array $arguments = [])
    {
        $this->id = strval($arguments["id"]);
    }
    
    public function getId(): string
    {
        return $this->id;
    }
}
