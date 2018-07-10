<?php
namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;

interface GuildChannelRepository
{
    
    public function save(GuildChannel $guild);
    
    public function findById(ChannelId $id) : ?GuildChannel;
    
}