<?php
namespace intrawarez\slimannotations\metadata;

use Doctrine\Common\Annotations\Reader;
use intrawarez\slimannotations\annotations\HttpMethod;
use intrawarez\slimannotations\annotations\Middlewares;

use function intrawarez\sabertooth\fn\predicates\_instanceOf;
use function intrawarez\sabertooth\fn\repeatables\filter;
use function intrawarez\sabertooth\fn\repeatables\first;

final class MethodMetadata extends AbstractMetadata
{
    /**
     * @var \ReflectionMethod
     */
    private $reflectionMethod;
    
    private $methods;
    private $middlewaresOptional;
    
    public function __construct(\ReflectionMethod $reflectionMethod, Reader $reader)
    {
        parent::__construct($reflectionMethod, $reader);
        
        $this->reflectionMethod = $reflectionMethod;
        
        $this->methods = filter($this->getAnnotations(), _instanceOf(HttpMethod::class));
        $this->middlewaresOptional = first(filter($this->getAnnotations(), _instanceOf(Middlewares::class)));
    }
    
    public function getReflectionMethod(): \ReflectionMethod
    {
        return $this->reflectionMethod;
    }
}
