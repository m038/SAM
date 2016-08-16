<?php

namespace intrawarez\slim3annotations;


use Slim\App;
use Interop\Container\ContainerInterface;
use intrawarez\sabertooth\reflection\Reflections;
use intrawarez\slim3annotations\annotations\SlimAnnotations;
use intrawarez\slim3annotations\annotations\Route;
use intrawarez\slim3annotations\annotations\Method;


/**
 * 
 * @author maxmeffert
 *
 */
final class AnnotatedApp extends App {
	
	
	/**
	 * Creates a new AnnotatedApp instances.
	 * @param ContainerInterface|array $container
	 * @return AnnotatedApp
	 */
	static public function from ($container) : AnnotatedApp {
		
		return new AnnotatedApp($container);
		
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
		
		parent::__construct($container);
		
		$this->init();
		
	}
	
	private function init () {
		
		if ($this->getContainer()->has("settings")) {
			
			$settings = $this->getContainer()->get("settings");
			
			if (isset($settings["namespaces"]) && is_array($settings["namespaces"])) {
				
				$namespaces = $settings["namespaces"];
						
				$this->loadAllNamespaces($namespaces);
							
			}
			
		}
		
	}
	
	/**
	 * 
	 * @param string $controller
	 */
	public function load (string $controller) {
		
		$class = Reflections::reflectionClassOf($controller);
		
		$route = SlimAnnotations::routeOf($class);
				
		if ($route instanceof Route) {
			
			$pattern = !empty($route->pattern) ? $route->pattern : "/";
			
			
			$reflectionMethods = Reflections::publicMethodsOf($class);
			
			$group = $this->group($pattern, function()use($reflectionMethods){
				
				foreach ($reflectionMethods as $reflectionMethod) {
				
					$method = SlimAnnotations::methodOf($reflectionMethod);
					$methodRoute = SlimAnnotations::routeOf($reflectionMethod);
					
					if ($method) {
						
						$pattern = strval($methodRoute instanceof Route ? $methodRoute->pattern : "");
						
						switch ($method->getName()) {
				
							case Method::GET:
								$route = $this->get($pattern,AnnotatedApp::callableName($reflectionMethod));
								break;
				
							case Method::POST:
								$route = $this->post($pattern,AnnotatedApp::callableName($reflectionMethod));
								break;
				
							case Method::PUT:
								$route = $this->put($pattern,AnnotatedApp::callableName($reflectionMethod));
								break;
				
							case Method::DELETE:
								$route = $this->delete($pattern,AnnotatedApp::callableName($reflectionMethod));
								break;
				
							case Method::OPTIONS:
								$route = $this->options($pattern,AnnotatedApp::callableName($reflectionMethod));
								break;
				
							case Method::ANY:
								$route = $this->any($pattern,AnnotatedApp::callableName($reflectionMethod));
								break;
									
				
						}
							
						foreach (SlimAnnotations::middlewaresOf($reflectionMethod) as $middleware) {
				
							$route->add($middleware->getName());
				
						}
							
					}
				
				}
				
			});
			
			foreach (SlimAnnotations::middlewaresOf($class) as $middleware) {
			
				$group->add($middleware->getName());
			
			}
				
			
			
		}
		
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