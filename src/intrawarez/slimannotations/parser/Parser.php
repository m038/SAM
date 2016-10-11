<?php
namespace intrawarez\slimannotations\parser;

use PhpParser\ParserFactory;
use PhpParser\Parser as PhpParser;
use Symfony\Component\Finder\Finder;

final class Parser 
{
    /**
     * 
     * @var PhpParser
     */
    private $parser;
    
    public function __construct()
    {
        $this->parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
    }
    
    /**
     * 
     * @param \SplFileInfo $file
     * @return \PhpParser\Node[]|NULL
     */
    public function parseSPLFile(\SplFileInfo $file): ParserResult
    {
        $stmts = $this->parser->parse(file_get_contents($file->getRealPath()));
        
        return new ParserResult($stmts);
    }
    
    /**
     * 
     * @param \Traversable $files
     * @return array
     */
    public function parseSPLFiles(\Traversable $files): ParserResults
    {
        $results = [];
        
        foreach ($files as $file) {
            if ($file instanceof \SplFileInfo) {
                $results[] = $this->parseSPLFile($file);
            }
        }
        
        return new ParserResults($results);
    }
    
    public function parseDir(string $dir): ParserResults
    {
        $files = (new Finder())->files()->in($dir);
        
        return $this->parseSPLFiles($files);
    }
    
    public function parseDirs(array $dirs): ParserResults
    {
        $files = (new Finder())->files()->in($dir);
        
        return $this->parseSPLFiles($files);
    }
}