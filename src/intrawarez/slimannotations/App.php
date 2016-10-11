<?php
namespace intrawarez\slimannotations;

use Interop\Container\ContainerInterface;
use intrawarez\sabertooth\reflection\Reflections;
use intrawarez\slimannotations\annotations\Group;
use intrawarez\slimannotations\annotations\Annotations;
use intrawarez\slimannotations\delegates\GroupDelegate;
use intrawarez\slimannotations\metadata\MetadataLoader;
use intrawarez\slimannotations\parser\Parser;
use intrawarez\slimannotations\metadata\MetadataFactory;
use Doctrine\Common\Annotations\AnnotationReader;

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
//         $container["callableResolver"] = function ($container) {
//             return new CallableResolver($container);
//         };
        
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
        
        $this->loadAllNamespaces($this->getNamespaces());
    }

    /**
     * Gets the array behind the container's <b>&#64;namespaces</b> id.
     *
     * @return array
     */
    final public function getNamespaces(): array
    {
        $id = "@namespaces";
        
        if ($this->getContainer()->has($id)) {
            $namespaces = $this->getContainer()->get($id);
            
            return is_array($namespaces) ? $namespaces : [];
        }
        
        return [];
    }

    /**
     * Loads a given class.
     *
     * @param string $controller The given class name.
     */
    public function load(string $className)
    {
        $class = Reflections::reflectionClassOf($className);
        
        $group = Annotations::group($class);
        
        if ($group->isPresent()) {
            
            /**
             *
             * @var Group $group
             */
            $group = $group->get();
            
            return $this->group($group->pattern, new GroupDelegate($className));
        }
    }

    /**
     * Loads all given classes.
     *
     * @param array $classNames The array of given class names.
     */
    public function loadAll(array $classNames)
    {
        foreach ($classNames as $className) {
            $this->load($className);
        }
    }

    /**
     * Loads all given namespaces.
     *
     *
     * @param string $namespace The given namespace name
     * @param string $directory The path to the given namespace's directory.
     */
    public function loadNamespace(string $namespace, string $directory)
    {
        $controllers = array_map(function ($filename) use ($namespace) {
            
            return $namespace . pathinfo($filename, PATHINFO_FILENAME);
        }, array_filter(scandir($directory), function ($file) {
            
            return $file != "." && $file != "..";
        }));
        
        $this->loadAll($controllers);
    }

    /**
     * Loads all given namespaces.
     *
     * The given namespaces are expected to be an associative array mapping namespace name to directory path.
     *
     * @param array $namespaces The of given namespaces.
     */
    public function loadAllNamespaces(array $namespaces)
    {
//         foreach ($namespaces as $namespace => $directory) {
//             $this->loadNamespace($namespace, $directory);
//         }

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
