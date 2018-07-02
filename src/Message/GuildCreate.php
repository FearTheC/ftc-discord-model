<?php declare(strict_types=1);

namespace FTC\Discord\Message;

use FTC\Discord\Message;
use FTC\Discord\Message\Traits\HasGuildPayload;

class GuildCreate extends Message
{
    use HasGuildPayload;
    
    const EVENT_NAME = 'GUILD_CREATE';
    
}
