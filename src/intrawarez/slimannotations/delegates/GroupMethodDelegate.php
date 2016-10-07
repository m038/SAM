<?php
namespace intrawarez\slimannotations\delegates;

use Interop\Container\ContainerInterface;
use intrawarez\slimannotations\DependencyInjector;

/**
 * Delegate implementation for group methods.
 *
 * @author maxmeffert
 *
 */
class GroupMethodDelegate implements DelegateInterface
{

    /**
     * The class name.
     *
     * @var string
     */
    private $className;

    /**
     * The method name.
     *
     * @var string
     */
    private $methodName;

    /**
     * Constructs a new GroupMethodDelegate instance.
     * @param string $className
     * @param string $methodName
     */
    public function __construct(string $className, string $methodName)
    {
        $this->className = $className;
        $this->methodName = $methodName;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \intrawarez\slim3annotations\DelegateInterface::getCallable()
     */
    public function getCallable(ContainerInterface $container): callable
    {
        $class = new \ReflectionClass($this->className);
        
        if ($class->hasMethod($this->methodName)) {
            return $class->getMethod($this->methodName)->getClosure(DependencyInjector::newInstance($class, $container));
        }
        
        throw new \Exception("Class {$this->className} has no method {$this->methodName}!");
    }
}
