<?php
namespace intrawarez\sam\delegates;

abstract class AbstractDelegate implements DelegateInterface
{
    /**
     * @var DelegateMapperInterface
     */
    private $mapper;
    
    public function __construct(DelegateMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
    
    public function getMapper(): DelegateMapperInterface
    {
        return $this->mapper;
    }
}
