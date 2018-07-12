<?php declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Aggregate\GuildWebsitePermission;
use FTC\Discord\Model\Collection;

class GuildWebsitePermissionCollection implements Collection
{
    /**
     * @var GuildWebsitePermission[];
     */
    private $permissions;
    
    public function __construct(GuildWebsitePermission ...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function add(GuildWebsitePermission $permission)
    {
        $this->permissions[] = $permission;
        
        return $this;
    }
    
    public function toArray()
    {
        return $this->permissions;
    }
    
    public function getIterator()
    {
        return $this->permissions;
    }
    
}
