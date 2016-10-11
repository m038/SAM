<?php
namespace intrawarez\slimannotations;

use intrawarez\slimannotations\metadata\ClassMetadata;
use Slim\App;
use intrawarez\slimannotations\delegates\GroupDelegate;

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
            $this->app->group($classMetadata->getGroupDeclaration()->pattern, new GroupDelegate($this->app, $this->instantiator, $classMetadata));
        }
    }
}
