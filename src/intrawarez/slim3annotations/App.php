<?php

namespace intrawarez\slim3annotations;


use Interop\Container\ContainerInterface;
use intrawarez\sabertooth\reflection\Reflections;
use intrawarez\slim3annotations\annotations\SlimAnnotations;
use intrawarez\slim3annotations\annotations\Route;
use intrawarez\slim3annotations\annotations\Method;
use Symfony\Component\Finder\Finder;
use intrawarez\slim3annotations\annotations\Group;


/**
 * 
 * @author maxmeffert
 *
 */
class App extends \Slim\App {
	
	
	/**
	 * Creates a new AnnotatedApp instances.
	 * @param array|\Interop\Container\ContainerInterface $container
	 * @return App
	 */
	static public function create ($container) : AnnotatedApp {
		
		return new App($container);
		
	}
	
	/**
	 * 
	 * @param \ReflectionMethod $method
	 * @return string
	 */
	static private function callableName (\ReflectionMethod $method) : string {
		return $method->getDeclaringClass()->getName() . ":" . $method->getName();
	}
	
	/**
	 * 
	 * @param unknown $container
	 */
	public function __construct($container) {
		
		$container["callableResolver"] = function($container){
// 			var_dump($container);
// 			throw new \Exception("asdf");
			return new CallableResolver($container);
		};
		
		parent::__construct($container);
		
// 		$this->registerCallableResolver();
		$this->init();
		
	}
	
	final public function getNamespaces () : array {
		
		$id = "@namespaces";
		
		if ($this->getContainer()->has($id)) {
				
			return $this->getContainer()->get($id);
				
		}
		
		return [];
		
	}
	
	
	
	
	private function init () {
		
		
		$this->loadAllNamespaces($this->getNamespaces());
		
// 		if ($this->getContainer()->has("settings")) {
			
// 			$settings = $this->getContainer()->get("settings");
			
// 			if (isset($settings["namespaces"]) && is_array($settings["namespaces"])) {
				
// 				$namespaces = $settings["namespaces"];
						
// 				$this->loadAllNamespaces($namespaces);
							
// 			}
			
// 		}
		
	}
	
	/**
	 * 
	 * @param string $controller
	 */
	public function load (string $controller) {
		
		$reflector = Reflections::reflectionClassOf($controller);
		
		$ann = AbstractDelegate::AnnotationReader()->getClassAnnotation($reflector, Group::class);
		
		if ($ann instanceof Group) {
			
// 			var_dump($delegate);
			
			$this->group($ann->pattern, new GroupDelegate($controller));
			
		}
		
// 		$route = SlimAnnotations::routeOf($class);
		
		
// 		if ($route instanceof Route) {
			
// 			$pattern = !empty($route->pattern) ? $route->pattern : "/";
		
// 			$this->group($pattern, new Delegate($controller));
			
// 			$reflectionMethods = Reflections::publicMethodsOf($class);
			
// 			$group = $this->group($pattern, function()use($reflectionMethods){
				
// 				foreach ($reflectionMethods as $reflectionMethod) {
				
// 					$method = SlimAnnotations::methodOf($reflectionMethod);
// 					$methodRoute = SlimAnnotations::routeOf($reflectionMethod);
					
// 					if ($method) {
						
// 						$pattern = strval($methodRoute instanceof Route ? $methodRoute->pattern : "");
						
// 						switch ($method->getName()) {
				
// 							case Method::GET:
// 								$route = $this->get($pattern,App::callableName($reflectionMethod));
// 								break;
				
// 							case Method::POST:
// 								$route = $this->post($pattern,App::callableName($reflectionMethod));
// 								break;
				
// 							case Method::PUT:
// 								$route = $this->put($pattern,App::callableName($reflectionMethod));
// 								break;
				
// 							case Method::DELETE:
// 								$route = $this->delete($pattern,App::callableName($reflectionMethod));
// 								break;
				
// 							case Method::OPTIONS:
// 								$route = $this->options($pattern,App::callableName($reflectionMethod));
// 								break;
				
// 							case Method::ANY:
// 								$route = $this->any($pattern,App::callableName($reflectionMethod));
// 								break;
									
				
// 						}
							
// 						foreach (SlimAnnotations::middlewaresOf($reflectionMethod) as $middleware) {
				
// 							$route->add($middleware->getName());
				
// 						}
							
// 					}
				
// 				}
				
// 			});

// 			foreach (SlimAnnotations::middlewaresOf($class) as $middleware) {
			
// 				$group->add($middleware->getName());
			
// 			}
				
			
			
// 		}
		
	}

	/**
	 * 
	 * @param array $controllers
	 */
	public function loadAll (array $controllers) {
		
		foreach ($controllers as $controller) {
			
			$this->load($controller);
			
		}
		
		
	}
	
	/**
	 * 
	 * @param string $namespace
	 * @param string $directory
	 */
	public function loadNamespace (string $namespace, string $directory)  {
		
// 		foreach(Finder::create()->in($directory)->files()->name("*.php") as $file) {
// 			var_dump($file);
// 		}
// 		die();
		
		$controllers = array_map(function($filename)use($namespace){
			
			return $namespace.pathinfo($filename,PATHINFO_FILENAME);
			
		}, array_filter(scandir($directory),function($file){
			
			return $file != "." && $file != "..";
			
		}));
			
		$this->loadAll($controllers);
		
	}
	
	/**
	 * 
	 * @param array $namespaces
	 */
	public function loadAllNamespaces (array $namespaces) {
		
		foreach ($namespaces as $namespace => $directory) {
			
			$this->loadNamespace($namespace, $directory);
			
		}
		
	}
	
}

?>