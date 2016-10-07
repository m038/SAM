<?php
namespace intrawarez\slimannotations\metadata;

use Doctrine\Common\Annotations\Reader;
use function intrawarez\sabertooth\util\repeatables\fn\filter;
use function intrawarez\sabertooth\callables\predicates\fn\_instanceOf;
use intrawarez\slimannotations\annotations\SlimAnnotation;

abstract class AbstractMetadata
{
    private $annotations = [];
    
    public function __construct(\Reflector $reflector, Reader $reader)
    {
        $annotations = [];
        
        if ($reflector instanceof \ReflectionClass) {
            $annotations = $reader->getClassAnnotations($reflector);
        }
        
        if ($reflector instanceof \ReflectionMethod) {
            $annotations = $reader->getMethodAnnotations($reflector);
        }
        
        if ($reflector instanceof \ReflectionProperty) {
            $annotations = $reader->getPropertyAnnotations($reflector);
        }
        
        $this->annotations = filter($annotations, _instanceOf(SlimAnnotation::class));
    }
    
    public function getAnnotations(): array
    {
        return $this->annotations;
    }
}