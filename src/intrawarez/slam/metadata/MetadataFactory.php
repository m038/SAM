<?php
namespace intrawarez\slam\metadata;

use Doctrine\Common\Annotations\Reader;

class MetadataFactory
{
    private $reader;
    
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }
    
    public function createClassMetadata(string $classname): ClassMetadata
    {
        return new ClassMetadata(new \ReflectionClass($classname), $this->reader);
    }
    
    public function createClassMetadatas(array $classnames)
    {
        $results = [];
        
        foreach ($classnames as $classname) {
            if (class_exists($classname)) {
                $classMetadata = $this->createClassMetadata($classname);
                if ($classMetadata->isAnnotated()) {
                    $results[$classname] = $classMetadata;
                }
            }
        }
        
        return $results;
    }
}
