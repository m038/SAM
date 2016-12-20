<?php

namespace intrawarez\sam\cli;

use Symfony\Component\Console\Application;
use intrawarez\sam\cli\commands\Validate;
use intrawarez\sam\cli\commands\Compile;

final class SAMConsole extends Application
{
    const NAME = "SAM";
    const VERSION = "1.0.0";

    public function __construct()
    {
        parent::__construct(self::NAME, self::VERSION);

        $this->add(new Validate());
        $this->add(new Compile());
    }
}
