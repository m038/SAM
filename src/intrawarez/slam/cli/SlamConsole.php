<?php
namespace intrawarez\slam\cli;

use Symfony\Component\Console\Application;
use intrawarez\slam\cli\commands\Validate;
use intrawarez\slam\cli\commands\Compile;

final class SlamConsole extends Application
{
    public function __construct()
    {
        parent::__construct("Slam", "1.0.0");
        
        $this->add(new Validate());
        $this->add(new Compile());
    }
}
