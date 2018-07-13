<?php declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Aggregate\GuildRole;
use FTC\Discord\Model\Collection;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;

class GuildRoleCollection implements Collection
{
    /**
     * @var GuildRole[];
     */
    private $roles;
    
    public function __construct(GuildRole ...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function add(GuildRole $role)
    {
        $this->roles[(string) $role->getId()] = $role;
        
        return $this;
    }
    
    public function getById(RoleId $id)
    {
        return $this->roles[$id->get()];
    }
    
    public function filterByIds(array $ids)
    {
        $filteredRoles = array_filter(
            $this->roles,
            function($role) use ($ids) {
                return in_array($role->getId()->get(), $ids);
            }
        );
        
        return new self(...$filteredRoles);
    }
    
    public function orderByPosition() : GuildRoleCollection
    {
        $orderedRoles = $this->roles;
        usort($orderedRoles, function($a, $b) { return ($a->getPosition() < $b->getPosition()); });
       
        return new self(...$orderedRoles);
    }
    
    public function count()
    {
        return count($this->roles);
    }
    
    public function getIterator()
    {
        return $this->roles;
    }
    
    
    public function toArray()
    {
        return $this->roles;
    }
}
