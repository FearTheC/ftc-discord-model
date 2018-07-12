<?php declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\Collection;

class GuildMemberIdCollection implements Collection
{
    /**
     * @var UserId[];
     */
    private $usersIds = [];
    
    public function __construct(UserId ...$usersIds)
    {
        array_map(['self', 'add'], $usersIds);
    }
    
    public function add(UserId $usersIds)
    {
        $this->usersIds[] = $usersIds;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->usersIds);
    }
    
    public function getIterator() : array
    {
        return $this->usersIds;
    }
    
    public function toArray()
    {
        return array_map(function($roleId) { return $roleId->get(); }, $this->usersIds);
    }
}
