<?php
namespace intrawarez\sam\delegates;

use intrawarez\sam\metadata\ClassMetadata;
use intrawarez\sam\metadata\MethodMetadata;

class GroupDelegate extends AbstractDelegate
{
    private $classMetadata;
    
    public function __construct(DelegateMapperInterface $mapper, ClassMetadata $classMetadata)
    {
        parent::__construct($mapper);
        $this->classMetadata = $classMetadata;
    }
    
    public function __invoke()
    {
        foreach ($this->classMetadata->getMethodMetadata() as $methodMetadata) {
            /**
             * @var MethodMetadata $methodMetadata
             */
            $actions = $methodMetadata->getMethods();
            $callable = new GroupActionDelegate($this->getMapper(), $methodMetadata);
            
            foreach ($actions as $action) {
                $this->getMapper()->action($action, $callable);
            }
        }
    }
}
