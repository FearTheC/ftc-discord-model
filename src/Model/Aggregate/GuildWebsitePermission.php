<?php declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;


use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;

class GuildWebsitePermission
{
    
    /**
     * @var GuildId
     */
    private $guildId;
    
    /**
     * @var RoleId
     */
    private $roleId;
    
    /**
     * @var string
     */
    private $routeName;
    
    public function __construct(
        GuildId $guildId,
        RoleId $roleId,
        string $routeName
    ) {
        $this->guildId = $guildId;
        $this->roleId = $roleId;
        $this->routeName = $routeName;
    }
    
    public function getGuildId() : GuildId
    {
        return $this->guildId;
    }
    
    public function getRoleName() : string
    {
        return (string) $this->roleId;
    }
    
    public function getRoleId() : RoleId
    {
        return $this->roleId;
    }
    
    public function getRouteName() : string
    {
        return $this->routeName;
    }
    
}
