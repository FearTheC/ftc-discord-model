<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\GuildMember;
use FTC\Discord\Model\ValueObject\Snowflake;

class GuildMemberCollection
{
    /**
     * @var GuildMember[];
     */
    private $members;
    
    public function __construct(GuildMember ...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function getById(Snowflake $id) : GuildMember
    {
        return $this->members[$id->get()];
    }
    
    public function add(GuildMember $member)
    {
        $this->members[$member->getId()->get()] = $member;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->members);
    }
    
    
    public function toArray()
    {
        return $this->members;
    }
}
