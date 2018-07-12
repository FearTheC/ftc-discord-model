<?php declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\Collection\GuildWebsitePermissionCollection;

interface GuildWebsitePermissionRepository
{
    public function save(GuildWebsitePermission $permission);
    
    public function getGuildPermissions(GuildId $guildId) : GuildWebsitePermissionCollection;
    
}