<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\Collection\GuildMessageCollection;
use FTC\Discord\Model\ValueObject\Snowflake\MessageId;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;

interface GuildMessageRepository
{
    
    public function save(GuildMessage $message);
    
    public function remove(GuildMessage $message);
    
    public function getAllForGuild(GuildId $guildId) : GuildMessageCollection;
    
    public function getAllForAuthor(GuildId $guildId, UserId $userId) : GuildMessageCollection;
    
    public function getAllForChannel(ChannelId $channelId) : GuildMessageCollection;
    
    public function findById(MessageId $messageId) : GuildMessage;
    
}
