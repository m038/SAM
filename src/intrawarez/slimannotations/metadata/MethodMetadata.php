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
    
    private $classMetadata;
    /**
     * @var \ReflectionMethod
     */
    private $reflectionMethod;
    
    private $methods;
    private $middlewaresOptional;
    
    public function __construct(ClassMetadata $classMetadata, \ReflectionMethod $reflectionMethod, Reader $reader)
    {
        parent::__construct($reflectionMethod, $reader);
        
        $this->classMetadata = $classMetadata;
        $this->reflectionMethod = $reflectionMethod;
        
        $this->methods = filter($this->getAnnotations(), _instanceOf(HttpMethod::class));
        $this->middlewaresOptional = first(filter($this->getAnnotations(), _instanceOf(Middlewares::class)));
    }
    
    public function getClassMetadata(): ClassMetadata
    {
        return $this->classMetadata;
    }
    
    public function getReflectionMethod(): \ReflectionMethod
    {
        return $this->reflectionMethod;
    }
    
    public function getMethods(): array
    {
        return $this->methods;
    }
}
