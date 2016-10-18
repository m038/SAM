<?php
namespace intrawarez\sam\parser;

use function intrawarez\sabertooth\fn\repeatables\filter;
use function intrawarez\sabertooth\fn\predicates\_instanceOf;

final class ParserResults implements \IteratorAggregate
{
    private $results;
    
    public function __construct(array $results)
    {
        $this->results = filter($results, _instanceOf(ParserResult::class));
    }
    
    public function getIterator()
    {
        return new \ArrayIterator($this->results);
    }
    
    public function getClassnames()
    {
        return array_reduce(array_map(function (ParserResult $result) {
            return $result->getClassnames();
        }, $this->results), "array_merge", []);
    }
}
