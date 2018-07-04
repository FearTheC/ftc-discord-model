<?php
namespace FTC\Discord\Model;

use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;

abstract class Channel
{
    const GUILD_TEXT = 0;
    const DM = 1;
    const GUILD_VOICE = 2;
    const GROUP_DM = 3;
    const GUILD_CATEGORY = 4;
    
    /**
     * @var ChannelId $id
     */
    private $id;
    
    protected function __construct(ChannelId $id)
    {
        $this->id = $id;
    }
    
}
