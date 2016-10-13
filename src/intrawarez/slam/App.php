<?php
namespace intrawarez\slam;

use Doctrine\Common\Annotations\AnnotationReader;
use Interop\Container\ContainerInterface;
use intrawarez\slam\metadata\MetadataFactory;
use intrawarez\slam\metadata\MetadataLoader;
use intrawarez\slam\parser\Parser;

/**
 * An extension of \Slim\App which loads its handlers automatically,
 * depending on annotation markup.
 *
 * @author maxmeffert
 *
 */
class App extends \Slim\App
{

    /**
     * Augments the container
     * @param array|\Interop\Container\ContainerInterface $container
     * @return array|\Interop\Container\ContainerInterface
     */
    private static function augmentContainer($container)
    {        
        return $container;
    }
    
    /**
     * Creates a new App instances.
     *
     * @param array|\Interop\Container\ContainerInterface $container
     * @return App
     */
    public static function create($container = []): App
    {
        return new App($container);
    }

    /**
     * Constructs a new App instance from a given container.
     *
     * @param array|\Interop\Container\ContainerInterface $container The given container.
     */
    public function __construct($container = [])
    {
        parent::__construct(self::augmentContainer($container));
    }

    
    public function load(array $namespaces)
    {
        $parser = new Parser();
        $reader = new AnnotationReader();
        $factory = new MetadataFactory($reader);
        $loader = new MetadataLoader($parser, $factory);
        $instantiator = new Instantiator($this->getContainer());
        $mapper = new Mapper($this, $instantiator);
        
        foreach ($loader->loadDirs($namespaces) as $classMetadata) {
            $mapper->mapClass($classMetadata);
        }
    }
}
