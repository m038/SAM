<?php
namespace intrawarez\slam\delegates;

use intrawarez\slam\metadata\MethodMetadata;
use Slim\App;
use intrawarez\slam\Instantiator;

class GroupActionDelegate extends AbstractDelegate
{
    private $metadata;
    
    public function __construct(App $app, Instantiator $instantiator, MethodMetadata $metadata)
    {
        parent::__construct($app, $instantiator);
        $this->metadata = $metadata;
    }
    
    public function __invoke()
    {
        $args = func_get_args();

        $instance = $this->getInstantiator()->createInstance($this->metadata->getClassMetadata());
        
        return $this->metadata->getReflectionMethod()->invokeArgs($instance, $args);
    }
}
