<?php
namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

interface GuildChannelRepository
{
    
    public function save(GuildChannel $guild, GuildId $guildId);
    
    public function findById(ChannelId $id) : ?GuildChannel;
    
}