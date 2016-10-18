<?php
namespace intrawarez\sam\annotations;

/**
 * The annotation for a middleware.
 *
 * @author maxmeffert
 * @Annotation
 */
class Middleware implements SlimAnnotation
{
    /**
     * @var string
     */
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
