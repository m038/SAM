<?php
namespace intrawarez\slam\cli\commands;

use Symfony\Component\Console\Command\Command;

class Compile extends Command
{
    protected function configure()
    {
        $this
        ->setName("compile")
        ->setDescription("Compiles mapping into 'routes.php'.");
    }
}
