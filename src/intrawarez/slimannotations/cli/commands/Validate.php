<?php
namespace intrawarez\slimannotations\cli\commands;

use Symfony\Component\Console\Command\Command;

class Validate extends Command
{
    protected function configure()
    {
        $this
        ->setName("validate")
        ->setDescription("Validates the mapping in a given directory.");
    }
}
