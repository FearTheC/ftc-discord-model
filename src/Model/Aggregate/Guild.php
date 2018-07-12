<?php
namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTC\Discord\Model\Collection\ChannelCollection;
use FTC\Discord\Model\Channel\GuildChannel;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Name\GuildName;
use FTC\Discord\Model\Collection\GuildChannelCollection;
use FTC\Discord\Model\ValueObject\DomainName;
use FTC\Discord\Model\Collection\GuildRoleIdCollection;
use FTC\Discord\Model\Collection\GuildMemberIdCollection;
use FTC\Discord\Model\Collection\GuildChannelIdCollection;

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
     * @var GuildRoleIdCollection $roles
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
    
    /**
     * @var DomainName $domainName
     */
    private $domainName;
    
    
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
    
    public function getDomainName()
    {
        return (string) $this->domainName;
    }
    
    public function getRoles() : GuildRoleIdCollection
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
        GuildRoleIdCollection$roles,
        GuildMemberIdCollection$members,
        GuildChannelIdCollection$channels,
        DomainName $domainName = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->ownerId = $ownerId;
        $this->roles = $roles;
        $this->members = $members;
        $this->channels = $channels;
        $this->domainName = $domainName;
    }
    
    public static function create(
        Snowflake $id,
        GuildName $name,
        Snowflake $ownerId,
        GuildRoleIdCollection $roles,
        GuildMemberIdCollection $members,
        GuildChannelIdCollection $channels,
        DomainName $domainName = null
        ) {
            return new self($id, $name, $ownerId, $roles, $members, $channels, $domainName);
    }
}
