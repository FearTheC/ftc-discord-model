<?php

declare(strict_types=1);

namespace FTC\Discord\Model;

use FTC\Discord\Model\ValueObject\Snowflake;

abstract class IdsCollection implements Collection
{
    
    /**
     * @var Snowflake
     */
    protected $ids = [];
    
    public function getHasNot(IdsCollection $comparedToIds) : IdsCollection
    {
        $this->checkIsComparable($this, $comparedToIds);
        
        $missingIds = array_map(
            [$comparedToIds, 'fetch'],
            array_diff_key($comparedToIds->toArray(), $this->toArray())
         );

        $class = get_class($this);

        return new $class(...$missingIds);
    }
    
    public function add(Snowflake $userId)
    {
        $this->ids[$userId->get()] = $userId;
        
        return $this;
    }
    
    public function fetch(int $id) : Snowflake 
    {
        return $this->ids[$id];
    }
    
    public function getIterator() : array
    {
        return $this->ids;
    }
    
    public function count() : int
    {
        return count($this->ids);
    }
    
    public function toArray() : array
    {
        return array_map(function($id) { return $id->get(); }, $this->ids);
    }
    
    private function checkIsComparable(IdsCollection $a, IdsCollection $b) : void
    {
        if (!is_a($b, get_class($a))) {
            throw new Exception();
        }
    }

}
