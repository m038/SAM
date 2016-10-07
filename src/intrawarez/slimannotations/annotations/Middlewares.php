<?php
namespace intrawarez\slimannotations\annotations;

/**
 * The annotation for middlewares.
 *
 * @author maxmeffert
 * @Annotation
 */
class Middlewares implements SlimAnnotation, \IteratorAggregate
{
    private $middlewares = [];
    
    public function __construct(array $arguments = [])
    {
        $middlewares = array_shift($arguments);
        $middlewares = is_array($middlewares) ? $middlewares : null;

        foreach ($middlewares as $middleware) {
            if ($middleware instanceof Middleware) {
                $this->middlewares[] = $middleware;
            }
        }
        
    }
    
    public function getIterator()
    {
        return new \ArrayIterator($this->middlewares);
    }
}