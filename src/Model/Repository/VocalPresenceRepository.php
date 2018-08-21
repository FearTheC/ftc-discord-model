<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Repository;

use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\ValueObject\Presence\VocalPresence;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;

interface VocalPresenceRepository
{
    
    public function save(VocalPresence $vocalPresence) : void;
    
    public function getLastPresence(UserId $memberId, GuildId $guildId) : ?VocalPresence;
    
}
