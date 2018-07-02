<?php declare(strict_types=1);

namespace FTC\Discord\Exception\Model\ValueObject\Snowflake;

final class InvalidSnowflakeException extends \InvalidArgumentException
{
    
    const SIZE_EXCEEDED_MSG = "Snowflakes are up to %d bits in size, %d bits value provided";
    const PRE_DISCORD_UE_MSG = "This Snowflake seems unreal: it indicates a time prior to Discord Unix Epoch";
    
    public function __construct($message)
    {
        parent::__construct($message);
    }
    
    public static function sizeIsTooBig($max, $actual)
    {
        return new self(sprintf(self::SIZE_EXCEEDED_MSG, $max, $actual));
    }
    
    public static function beforeDiscordUnixEpoch()
    {
        return new self(self::PRE_DISCORD_UE_MSG);
    }
}
