<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\Collection;
use FTC\Discord\Model\IdsCollection;

class GuildChannelIdCollection extends IdsCollection
{
    
    public function __construct(ChannelId ...$channelsIds)
    {
        array_map(['self', 'add'], $channelsIds);
    }

}
