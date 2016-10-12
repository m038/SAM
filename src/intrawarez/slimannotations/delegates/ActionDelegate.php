<?php
namespace intrawarez\slimannotations\delegates;

use intrawarez\slimannotations\Instantiator;
use intrawarez\slimannotations\metadata\ClassMetadata;
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
