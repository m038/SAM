<?php
namespace intrawarez\sam\cli;

use Symfony\Component\Console\Application;
use intrawarez\sam\cli\commands\Validate;
use intrawarez\sam\cli\commands\Compile;

final class SAMConsole extends Application
{
    public function __construct()
    {
        parent::__construct("sam", "1.0.0");
        
        $this->add(new Validate());
        $this->add(new Compile());
    }
}
