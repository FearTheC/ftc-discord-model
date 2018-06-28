<?php
namespace FTC\Discord\Model;

use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\ValueObject\ChannelType;

abstract class Channel
{
    /**
     * @var Snowflake $id
     */
    private $id;
    
    /**
     * @var string $name
     */
    private $name;
    
    /**
     * @var string $topic
     */
    private $topic;

    /**
     * @var ChannelType $type
     */
    private $type;
    
    /**
     * @var Snowflake $guildId
     */
    private $guildId;
    
    /**
     * @var Snowflake $categoryId
     */
    private $categoryId;
    
    
}
