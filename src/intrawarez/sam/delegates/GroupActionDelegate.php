<?php
namespace intrawarez\sam\delegates;

use intrawarez\sam\metadata\MethodMetadata;

class GroupActionDelegate extends AbstractDelegate
{
    private $methodMetadata;
    
    public function __construct(DelegateMapperInterface $mapper, MethodMetadata $methodMetadata)
    {
        parent::__construct($mapper);
        $this->methodMetadata = $methodMetadata;
    }
    
    public function __invoke()
    {
        $args = func_get_args();

        $instance = $this->getMapper()->getInstantiator()->createInstance($this->methodMetadata->getClassMetadata());
        
        return $this->methodMetadata->getReflectionMethod()->invokeArgs($instance, $args);
    }
}
