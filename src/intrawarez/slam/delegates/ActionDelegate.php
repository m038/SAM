<?php
namespace intrawarez\slam\delegates;

use intrawarez\slam\Instantiator;
use intrawarez\slam\metadata\ClassMetadata;
use Slim\App;

class ActionDelegate extends AbstractDelegate
{
    private $classMetadata;
    
    public function __construct(App $app, Instantiator $instantiator, ClassMetadata $classMetadata)
    {
        parent::__construct($app, $instantiator);
        $this->classMetadata = $classMetadata;
    }
    
    public function __invoke()
    {
        $instance = $this->getInstantiator()->createInstance($this->classMetadata);
        
        return call_user_func_array($instance, func_get_args());
    }
}
