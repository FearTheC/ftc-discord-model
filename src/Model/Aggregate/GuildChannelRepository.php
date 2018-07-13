<?php
namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\Collection\GuildChannelCollection;

interface GuildChannelRepository
{
    
    public function save(GuildChannel $guild, GuildId $guildId);
    
    public function findById(ChannelId $id) : ?GuildChannel;
    
    public function getAll(GuildId $id) : GuildChannelCollection;
    
}