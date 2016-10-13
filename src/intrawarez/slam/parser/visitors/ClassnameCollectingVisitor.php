<?php
namespace intrawarez\slam\parser\visitors;

use PhpParser\NodeVisitor\NameResolver;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;

class ClassnameCollectingVisitor extends NameResolver
{
    private $classnames = [];
    
    public function getClassnames(): array
    {
        return $this->classnames;
    }
    
    public function enterNode(Node $node)
    {
        parent::enterNode($node);
        
        if ($node instanceof Class_) {
            $this->classnames[] = $node->namespacedName->toString();
        }
    }
}
