<?php
namespace intrawarez\slimannotations\delegates;

use Slim\App;
use intrawarez\slimannotations\metadata\ClassMetadata;
use intrawarez\slimannotations\metadata\MethodMetadata;
use intrawarez\slimannotations\annotations\GET;
use intrawarez\slimannotations\Instantiator;

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
