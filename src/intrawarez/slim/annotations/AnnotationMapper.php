<?php

namespace intrawarez\sabertooth\slim\annotations;

use Slim;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use intrawarez\sabertooth\reflection\Reflections;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

AnnotationRegistry::registerFile(__DIR__."/Route.php");
AnnotationRegistry::registerFile(__DIR__."/Middleware.php");
AnnotationRegistry::registerFile(__DIR__."/Group.php");
AnnotationRegistry::registerFile(__DIR__."/GET.php");
AnnotationRegistry::registerFile(__DIR__."/POST.php");
AnnotationRegistry::registerFile(__DIR__."/PUT.php");
AnnotationRegistry::registerFile(__DIR__."/DELETE.php");
AnnotationRegistry::registerFile(__DIR__."/OPTIONS.php");
AnnotationRegistry::registerFile(__DIR__."/ANY.php");

final class AnnotationMapper {
	
	static private function callableName (\ReflectionMethod $method) {
		return $method->getDeclaringClass()->getName() . ":" . $method->getName();
	}
	
	/**
	 * 
	 * @var \Slim\App
	 */
	private $app;
	
	/**
	 * 
	 * @var \Doctrine\Common\Annotations\AnnotationReader
	 */
	private $reader;
	
	public function __construct (\Slim\App $app) {
		
		$this->app = $app;
		
		$this->reader = new AnnotationReader();
		
	}
	
	public function getApp () {
		
		return $this->app;
		
	}
		
	public function map ($controller) {
		
		$class = Reflections::reflectionClassOf($controller);
		
		$route = AnnotationInfo::routeOf($class);
		
		if ($route instanceof Route) {
			
			$pattern = $route->pattern;
			
			$reflectionMethods = Reflections::publicMethodsOf($class);
			
			$group = $this->getApp()->group($pattern, function()use($reflectionMethods){
				
				foreach ($reflectionMethods as $reflectionMethod) {
				
					$method = AnnotationInfo::methodOf($reflectionMethod);
					$methodRoute = AnnotationInfo::routeOf($reflectionMethod);
				
					if ($method) {
						
						$pattern = strval($methodRoute instanceof Route ? $methodRoute->pattern : "");
						
						switch ($method->getName()) {
				
							case Method::GET:
								$route = $this->get($pattern,AnnotationMapper::callableName($reflectionMethod));
								break;
				
							case Method::POST:
								$route = $this->post($pattern,AnnotationMapper::callableName($reflectionMethod));
								break;
				
							case Method::PUT:
								$route = $this->put($pattern,AnnotationMapper::callableName($reflectionMethod));
								break;
				
							case Method::DELETE:
								$route = $this->delete($pattern,AnnotationMapper::callableName($reflectionMethod));
								break;
				
							case Method::OPTIONS:
								$route = $this->options($pattern,AnnotationMapper::callableName($reflectionMethod));
								break;
				
							case Method::ANY:
								$route = $this->any($pattern,AnnotationMapper::callableName($reflectionMethod));
								break;
									
				
						}
							
						foreach (AnnotationInfo::middlewaresOf($reflectionMethod) as $middleware) {
				
							$route->add($middleware->getName());
				
						}
							
					}
				
				}
				
			});
			
			foreach (AnnotationInfo::middlewaresOf($class) as $middleware) {
			
				$group->add($middleware->getName());
			
			}
				
			
			
		}
		
	}

	public function mapAll (array $controllers) {
		
		foreach ($controllers as $controller) {
			
			$this->map($controller);
			
		}
		
	}
	
	public function mapNamespace ($namespace, $directory) {
		
		$finder = new Finder();
		
		foreach ($finder->files()->in($directory) as $file) {
			
			/**
			 * @var SplFileInfo $file
			 */
			
			$this->map($namespace.$file->getBasename(".php"));
			
		}
		
	}
	
	public function compile ($controller) {
		
		$code = "<?php\n\n";
		
		$class = Reflections::reflectionClassOf($controller);
		
		$route = $this->getReader()->getClassAnnotation($class, Route::class);
		
		if ($route instanceof Route) {
			
			foreach (Reflections::publicMethodsOf($class) as $method) {
				
				var_dump($this->getReader()->getMethodAnnotation($method, Method::class));
				die();
				
				if ($this->getReader()->getMethodAnnotation($method, GET::class)) {

					$code .= "\$app->get(\"{$route->pattern}\", \"{$this->handlerName($method)}\");\n";
					continue;
					
				}
				
				if ($this->getReader()->getMethodAnnotation($method, POST::class)) {

					$code .= "\$app->get(\"{$route->pattern}\", \"{$this->handlerName($method)}\");\n";
					continue;
					
				}
				
				if ($this->getReader()->getMethodAnnotation($method, PUT::class)) {

					$code .= "\$app->get(\"{$route->pattern}\", \"{$this->handlerName($method)}\");\n";
					continue;
					
				}
				
				if ($this->getReader()->getMethodAnnotation($method, DELETE::class)) {

					$code .= "\$app->get(\"{$route->pattern}\", \"{$this->handlerName($method)}\");\n";
					continue;
					
				}
				
				if ($this->getReader()->getMethodAnnotation($method, OPTIONS::class)) {

					$code .= "\$app->get(\"{$route->pattern}\", \"{$this->handlerName($method)}\");\n";
					continue;
					
				}
				
				if ($this->getReader()->getMethodAnnotation($method, ANY::class)) {

					$code .= "$\app->get(\"{$route->pattern}\", \"{$this->handlerName($method)}\");\n";
					continue;
					
				}
				
				$code .= "\n";
				
			}
			
		}
		
		$code .= "\n\n?>";
		
		return $code;
		
	}

	
}

?>