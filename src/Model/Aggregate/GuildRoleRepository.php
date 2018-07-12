<?php declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\ValueObject\Name\RoleName;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

interface GuildRoleRepository
{
    public function save(GuildRole $member, GuildId $guildId);
    
    public function getAll(GuildId $guildId) : GuildRoleCollection;
    
    public function findById(RoleId $id) : GuildRole;
    
    public function findByName(RoleName $name, GuildId $guildId) : ?GuildRole;
    
    public function getEveryoneRole(GuildId $guildId) : GuildRole;
    
}