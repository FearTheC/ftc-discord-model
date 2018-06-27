<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\GuildRole;

class GuildRoleCollection
{
    /**
     * @var GuildRole[];
     */
    private $roles;
    
    public function __construct(GuildRole ...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function add(GuildRole$role)
    {
        $this->roles[$role->getId()] = $role;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->roles);
    }
    
    
    public function toArray()
    {
        return $this->roles;
    }
}
