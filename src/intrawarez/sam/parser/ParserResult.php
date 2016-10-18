<?php
namespace intrawarez\sam\parser;

use PhpParser\NodeTraverser;
use intrawarez\sam\parser\visitors\ClassnameCollectingVisitor;

final class ParserResult
{
    /**
     * @var array
     */
    private $stmts;
    
    public function __construct(array $stmts)
    {
        $this->stmts = $stmts;
    }
    
    public function getClassnames()
    {
        $classnameCollector = new ClassnameCollectingVisitor();
        
        $traverser = new NodeTraverser();
        $traverser->addVisitor($classnameCollector);
        
        $traverser->traverse($this->stmts);
        
        return $classnameCollector->getClassnames();
    }
}
