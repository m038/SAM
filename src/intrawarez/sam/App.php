<?php
namespace intrawarez\sam;

use Doctrine\Common\Annotations\AnnotationReader;
use Interop\Container\ContainerInterface;
use intrawarez\sam\metadata\MetadataFactory;
use intrawarez\sam\metadata\MetadataLoader;
use intrawarez\sam\parser\Parser;
use intrawarez\sam\delegates\DelegateMapper;

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
        $mapper = new DelegateMapper($this);
        
        foreach ($loader->loadDirs($namespaces) as $classMetadata) {
            $mapper->map($classMetadata);
        }
    }
}
