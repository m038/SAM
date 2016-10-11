<?php
namespace intrawarez\slimannotations\metadata;

use Doctrine\Common\Annotations\Reader;

use intrawarez\slimannotations\annotations\SlimAnnotation;
use function intrawarez\sabertooth\fn\repeatables\filter;
use function intrawarez\sabertooth\fn\predicates\_instanceOf;

/**
 * Abstract base class for metadata.
 * @author maxmeffert
 */
abstract class AbstractMetadata
{
    /**
     * The Slim annotations.
     * @var array
     */
    private $annotations = [];
    
    /**
     * Constructs a new metadata instance.
     * Reads the Slim annotations form the given reflector.
     *
     * @param \Reflector $reflector
     * @param Reader $reader
     */
    public function __construct(\Reflector $reflector, Reader $reader)
    {
        $annotations = [];
        
        if ($reflector instanceof \ReflectionClass) {
            $annotations = $reader->getClassAnnotations($reflector);
        } elseif ($reflector instanceof \ReflectionMethod) {
            $annotations = $reader->getMethodAnnotations($reflector);
        } elseif ($reflector instanceof \ReflectionProperty) {
            $annotations = $reader->getPropertyAnnotations($reflector);
        }
        
        $this->annotations = filter($annotations, _instanceOf(SlimAnnotation::class));
    }
    
    /**
     * Whether the the reflector has Slim annotations
     * @return bool
     */
    public function isAnnotated(): bool
    {
        return count($this->annotations) > 0;
    }
    
    /**
     * Gets the Slim annotations.
     * @return array
     */
    public function getAnnotations(): array
    {
        return $this->annotations;
    }
}
