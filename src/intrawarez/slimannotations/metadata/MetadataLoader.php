<?php
namespace intrawarez\slimannotations\metadata;

use intrawarez\slimannotations\parser\Parser;

class MetadataLoader
{
    private $parser;
    private $factory;
    
    public function __construct(Parser $parser, MetadataFactory $factory)
    {
        $this->parser = $parser;
        $this->factory = $factory;
    }
    
    public function loadDir(string $dir): array
    {
        return $this->factory->createClassMetadatas($this->parser->parseDir($dir)->getClassnames());
    }
    
    public function loadDirs(array $dirs): array
    {
        return $this->factory->createClassMetadatas($this->parser->parseDirs($dirs)->getClassnames());
    }
}