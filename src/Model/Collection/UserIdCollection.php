<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\Collection;
use FTC\Discord\Model\IdsCollection;

class UserIdCollection extends IdsCollection
{
    
    public function __construct(UserId ...$usersIds)
    {
        array_map(['self', 'add'], $usersIds);
    }

}
