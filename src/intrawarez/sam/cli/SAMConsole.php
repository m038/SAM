<?php
namespace intrawarez\sam\cli;

use Symfony\Component\Console\Application;
use intrawarez\sam\cli\commands\Validate;
use intrawarez\sam\cli\commands\Compile;

final class SAMConsole extends Application
{
<<<<<<< HEAD
<<<<<<< HEAD
    const NAME = "SAM";
    const VERSION = "1.0.0";
    
    public function __construct()
    {
        parent::__construct(self::NAME, self::VERSION);
=======
    public function __construct()
    {
        parent::__construct("sam", "1.0.0");
>>>>>>> 77690e8104c4d1850bada6375323f7d89848d8db
=======
    public function __construct()
    {
        parent::__construct("sam", "1.0.0");
>>>>>>> 77690e8104c4d1850bada6375323f7d89848d8db
        
        $this->add(new Validate());
        $this->add(new Compile());
    }
}
