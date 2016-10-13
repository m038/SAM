<?php
namespace intrawarez\slam;

use intrawarez\slam\delegates\ActionDelegate;
use intrawarez\slam\delegates\GroupDelegate;
use intrawarez\slam\metadata\ClassMetadata;
use Slim\App;

class Mapper
{
    private $app;
    private $instantiator;
    
    public function __construct(App $app, Instantiator $instantiator)
    {
        $this->app = $app;
        $this->instantiator = $instantiator;
    }
    
    public function mapClass(ClassMetadata $classMetadata)
    {
        if ($classMetadata->isGroupDeclaration()) {
            $this->app->group($classMetadata->getGroupDeclaration()->getPattern(), new GroupDelegate($this->app, $this->instantiator, $classMetadata));
        } elseif ($classMetadata->isActionDeclaration()) {
            $httpMethod = $classMetadata->getActionDeclaration();
            if ($httpMethod instanceof GET) {
                $this->getApp()->get($httpMethod->getPattern(), new ActionDelegate($this->app, $this->instantiator, $classMetadata));
            }
        }
    }
}
