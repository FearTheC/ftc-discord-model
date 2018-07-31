<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Channel\DMChannel;

use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\Channel\DMChannel\DM;

interface DMRepository
{
    
    public function save(DM $channel);
    
    public function delete(ChannelId $channelId) : bool;
    
}
