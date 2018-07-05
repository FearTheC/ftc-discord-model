<?php
namespace FTC\Discord\Model;

use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTC\Discord\Model\Collection\ChannelCollection;
use FTC\Discord\Model\Channel\GuildChannel;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Name\GuildName;
use FTC\Discord\Model\Collection\GuildChannelCollection;

class Guild
{
    /**
     * @var GuildId $id
     */
    private $id;
    
    /**
     * @var GuildName $name
     */
    private $name;
    
    /**
     * @var UserId $ownerId
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
    
    
    public function getOwnerId() : UserId
    {
        return $this->ownerId;
    }
    
    public function getName() : GuildName
    {
        return $this->name;
    }
    
    public function getId() : GuildId
    {
        return $this->id;
    }
    
    public function getRoles() : GuildRoleCollection
    {
        return $this->roles;
    }
    
    public function getChannels() : GuildChannelCollection
    {
        return $this->channels;
    }
    
    public function getMembers() : GuildMemberCollection
    {
        return $this->members;
    }
    
    private function __construct(
        GuildId $id,
        GuildName $name,
        UserId $ownerId,
        GuildRoleCollection $roles,
        GuildMemberCollection $members,
        GuildChannelCollection $channels
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->ownerId = $ownerId;
        $this->roles = $roles;
        $this->members = $members;
        $this->channels = $channels;
    }
    
    public static function create(
        Snowflake $id,
        GuildName $name,
        Snowflake $ownerId,
        GuildRoleCollection $roles,
        GuildMemberCollection $members,
        GuildChannelCollection $channels
        ) {
            return new self($id, $name, $ownerId, $roles, $members, $channels);
    }
}
