<?php
namespace FTC\Discord\Model;

use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTC\Discord\Model\Collection\ChannelCollection;
use FTC\Discord\Model\Channel\GuildChannel;

class Guild
{
    /**
     * @var Snowflake $id
     */
    private $id;
    
    /**
     * @var string $name
     */
    private $name;
    
    /**
     * @var Snowflake $ownerId
     */
    private $ownerId;
    
    /**
     * @var GuildRoleCollection $roles
     */
    private $roles;
    
    /**
     * @var GuildMemberCollection $members
     */
    private $members;
    
    /**
     * @var ChannelCollection
     */
    private $channels;
    
    
    public function getOwner() : GuildMember
    {
        return $this->members->getById($this->ownerId);
    }
    
    
    public function getOwnerId() : Snowflake
    {
        return $this->ownerId;
    }
    
    public function getName() : string
    {
        return $this->name;
    }
    
    public function getId() : Snowflake
    {
        return $this->id;
    }
    
    public function getRoles() : GuildRoleCollection
    {
        return $this->roles;
    }
    
    public function getMembers() : GuildMemberCollection
    {
        return $this->members;
    }
    
    private function __construct(
        Snowflake $id,
        string $name,
        Snowflake $ownerId,
        GuildRoleCollection $roles,
        GuildMemberCollection $members
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->ownerId = $ownerId;
        $this->roles = $roles;
        $this->members = $members;
    }
    
    public static function create(
        Snowflake $id,
        string $name,
        Snowflake $ownerId,
        GuildRoleCollection $roles,
        GuildMemberCollection $members
        ) {
            return new self($id, $name, $ownerId, $roles, $members);
    }
}
