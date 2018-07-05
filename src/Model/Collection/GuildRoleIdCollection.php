<?php declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\ValueObject\Snowflake\RoleId;

class GuildRoleIdCollection implements \IteratorAggregate
{
    /**
     * @var RoleId[];
     */
    private $rolesIds = [];
    
    public function __construct(RoleId ...$rolesIds)
    {
        array_map(['self', 'add'], $rolesIds);
    }
    
    public function add(RoleId $rolesIds)
    {
        $this->rolesIds[] = $rolesIds;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->rolesIds);
    }
    
    public function getIterator() : array
    {
        return $this->rolesIds;
    }
    
    
    public function toArray()
    {
        return $this->rolesIds;
    }
}
