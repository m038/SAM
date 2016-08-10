<?php

namespace intrawarez\slim\annotations;


use Interop\Container\ContainerInterface;
use intrawarez\sabertooth\reflection\Reflections;
use Slim\App;


/**
 * 
 * @author maxmeffert
 *
 */
final class AnnotatedApp extends App {
	
	
	/**
	 * Creates a new AnnotatedApp instances from a given container and an array of namespaces.
	 * 
	 * @param ContainerInterface|array $container The given container.
	 * @param array $namespaces The given namespaces as namespace-directory mapping.
	 * @return AnnotatedApp
	 */
	static public function from ($container, array $namespaces) : AnnotatedApp {
		
		$app = new AnnotatedApp($container);
		
		foreach ($namespaces as $namespace => $directory) {
			
			$app->loadNamespace($namespace, $directory);
			
		}
		
		return $app;
		
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
						
						$pattern = strval($methodRoute instanceof Route && !empty($methodRoute->pattern) ? $methodRoute->pattern : "");
						
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
	
}

?>