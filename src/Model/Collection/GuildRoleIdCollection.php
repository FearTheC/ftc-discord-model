<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\Collection;
use FTC\Discord\Model\IdsCollection;

class GuildRoleIdCollection extends IdsCollection
{
    
    public function __construct(RoleId ...$rolesIds)
    {
        array_map(['self', 'add'], $rolesIds);
    }
    
}
