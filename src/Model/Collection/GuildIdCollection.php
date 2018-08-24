<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Collection;
use FTC\Discord\Model\IdsCollection;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

class GuildIdCollection extends IdsCollection
{
    /**
     * @var GuildId[];
     */
    private $guildsIds = [];
    
    public function __construct(GuildId ...$guildsIds)
    {
        array_map(['self', 'add'], $guildsIds);
    }

}
