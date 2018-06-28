<?php declare(strict_types=1);

namespace FTC\Discord\Model\Channel;

use FTC\Discord\Model\Channel;
use FTC\Discord\Model\ValueObject\Snowflake;

abstract class GuildChannel extends Channel
{
    
    /**
     * @var Snowflake $guildId
     */
    private $guildId;

    /**
     * @var Snowflake $categoryId
     */
    private $categoryId;
    
    /**
     * @var int $position
     */
    private $position;
    
    
    
}
