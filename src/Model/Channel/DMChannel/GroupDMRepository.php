<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Channel\DMChannel;

use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\Channel\DMChannel\GroupDM;

interface GroupDMRepository
{
    
    public function save(GroupDM $channel) : bool;
    
    public function delete(ChannelId $channelId) : bool;
    
}
