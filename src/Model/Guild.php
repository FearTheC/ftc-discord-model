<?php
namespace FTC\Discord\Model;

use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTC\Discord\Model\Collection\ChannelCollection;

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
}
