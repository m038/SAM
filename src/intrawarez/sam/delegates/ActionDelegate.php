<?php
namespace intrawarez\sam\delegates;

use intrawarez\sam\metadata\ClassMetadata;

class ActionDelegate extends AbstractDelegate
{
    private $classMetadata;
    
    public function __construct(DelegateMapperInterface $mapper, ClassMetadata $classMetadata)
    {
        parent::__construct($mapper);
        $this->classMetadata = $classMetadata;
    }
    
    public function __invoke()
    {
        $instance = $this->getInstantiator()->createInstance($this->classMetadata);
        
        return call_user_func_array($instance, func_get_args());
    }
}
