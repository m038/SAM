<?php
namespace intrawarez\slimannotations\metadata;

use Doctrine\Common\Annotations\Reader;

use intrawarez\slimannotations\annotations\SlimAnnotation;
use function intrawarez\sabertooth\fn\repeatables\filter;
use function intrawarez\sabertooth\fn\predicates\_instanceOf;

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
    
    public function isAnnotated(): bool
    {
        return count($this->annotations) > 0;
    }
    
    public function getAnnotations(): array
    {
        return $this->annotations;
    }
}
