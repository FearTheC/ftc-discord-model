<?php declare(strict_types=1);

namespace FTC\Discord\Model\Channel\GuildChannel;


use FTC\Discord\Model\Channel\GuildChannel;

class Voice extends GuildChannel
{
    
    const TYPE = 2;
    
    /**
     * @var int $userLimit
     */
    private $userLimit;
    
    /**
     * @var int $bitrate
     */
    private $bitrate;
    
    
}
