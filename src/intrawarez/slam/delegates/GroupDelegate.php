<?php
namespace intrawarez\slam\delegates;

use Slim\App;
use intrawarez\slam\metadata\ClassMetadata;
use intrawarez\slam\metadata\MethodMetadata;
use intrawarez\slam\annotations\GET;
use intrawarez\slam\Instantiator;

class GroupDelegate extends AbstractDelegate
{
    private $metadata;
    
    public function __construct(App $app, Instantiator $instantiator, ClassMetadata $metadata)
    {
        parent::__construct($app, $instantiator);
        $this->metadata = $metadata;
    }
    
    public function __invoke()
    {
        foreach ($this->metadata->getMethodMetadata() as $methodMetadata) {
            /**
             * @var MethodMetadata $methodMetadata
             */
            $httpMethods = $methodMetadata->getMethods();
            
            foreach ($httpMethods as $httpMethod) {
                if ($httpMethod instanceof GET) {
                    $this->getApp()->get($httpMethod->getPattern(), new GroupActionDelegate($this->getApp(), $this->getInstantiator(), $methodMetadata));
                }
            }
        }
    }
}
