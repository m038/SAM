<?php
namespace intrawarez\slimannotations;

use Interop\Container\ContainerInterface;
use intrawarez\slimannotations\annotations\Method;
use intrawarez\slimannotations\annotations\GET;
use intrawarez\slimannotations\annotations\POST;
use intrawarez\slimannotations\annotations\PUT;
use intrawarez\slimannotations\annotations\DELETE;
use intrawarez\slimannotations\annotations\OPTIONS;
use intrawarez\slimannotations\annotations\ANY;
use intrawarez\slimannotations\annotations\Annotations;

/**
 * Delegate implementation for Slim groups.
 *
 * @author maxmeffert
 *
 */
class GroupDelegate implements DelegateInterface
{

    /**
     * The class name.
     * @var string
     */
    private $className;

    /**
     * Constructs a new GroupDelegate instance.
     * @param string $className
     */
    public function __construct(string $className)
    {
        $this->className = $className;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \intrawarez\slim3annotations\DelegateInterface::getCallable()
     */
    public function getCallable(ContainerInterface $container): callable
    {
        $className = $this->className;
        
        return function () use ($className) {
            
            /**
             *
             * @var \Slim\App $app;
             */
            $app = $this;
            
            $class = new \ReflectionClass($className);
            
            foreach ($class->getMethods(\ReflectionMethod::IS_PUBLIC) as $rm) {
                
                /**
                 *
                 * @var \ReflectionMethod $rm
                 */
                
                $method = Annotations::Method($rm);
                
                if ($method->isPresent()) {
                    
                    /**
                     *
                     * @var Method $method
                     */
                    
                    $method = $method->get();
                    
                    $pattern = $method->pattern;
                    
                    $callback = new GroupMethodDelegate($className, $rm->getName());
                    
                    if ($method instanceof GET) {
                        $app->get($pattern, $callback);
                    } elseif ($method instanceof POST) {
                        $app->post($pattern, $callback);
                    } elseif ($method instanceof PUT) {
                        $app->put($pattern, $callback);
                    } elseif ($method instanceof DELETE) {
                        $app->delete($pattern, $callback);
                    } elseif ($method instanceof OPTIONS) {
                        $app->options($pattern, $callback);
                    } elseif ($method instanceof ANY) {
                        $app->any($pattern, $callback);
                    }
                }
            }
        };
    }
}
