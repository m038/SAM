<?php

namespace intrawarez\slimannotations;

use Interop\Container\ContainerInterface;
use intrawarez\sabertooth\reflection\Reflections;
use intrawarez\slimannotations\annotations\Group;
use intrawarez\slimannotations\annotations\Annotations;


/**
 * An extension of \Slim\App which loads its handlers automatically,
 * depending on annotation markup.
 * 
 * @author maxmeffert
 *
 */
class App extends \Slim\App {
	
	
	/**
	 * Creates a new App instances.
	 * @param array|\Interop\Container\ContainerInterface $container
	 * @return App
	 */
	static public function create ($container = []) : App {
		
		return new App($container);
		
	}
		
	/**
	 * Constructs a new App instance from a given container.
	 * 
	 * @param array|\Interop\Container\ContainerInterface $container The given container.
	 */
	public function __construct($container = []) {
		
		$container["callableResolver"] = function($container){
			
			return new CallableResolver($container);
			
		};
		
		parent::__construct($container);
		
		$this->loadAllNamespaces($this->getNamespaces());
		
	}
	
	/**
	 * Gets the array behind the container's <b>&#64;namespaces</b> id.
	 * 
	 * @return array
	 */
	final public function getNamespaces () : array {
		
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
	public function load (string $className) {
		
		$class = Reflections::reflectionClassOf($className);
		
		$group = Annotations::Group($class);
		
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
	public function loadAll (array $classNames) {
		
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
	public function loadNamespace (string $namespace, string $directory)  {
				
		$controllers = array_map(function($filename)use($namespace){
			
			return $namespace.pathinfo($filename,PATHINFO_FILENAME);
			
		}, array_filter(scandir($directory),function($file){
			
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
	public function loadAllNamespaces (array $namespaces) {
		
		foreach ($namespaces as $namespace => $directory) {
			
			$this->loadNamespace($namespace, $directory);
			
		}
		
	}
	
}

?>