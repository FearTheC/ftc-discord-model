<?php
declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

use FTC\Discord\Exception\Model\ValueObject\Snowflake\InvalidSnowflakeException;
use FTC\Discord\Model\ModelObject;

class Snowflake implements ModelObject
{
    const BIT_MAX_SIZE = 64;
    
    const TIMESTAMP_BIT_SIZE = 22;
    
    const DISCORD_UNIX_EPOCH = 1420070400000;
    
    const SIZE_EXCEEDED_MSG = "Snowflakes are up to %d bits in size, %d bits value provided";
    
    /**
     * @var int $value
     */
    private $value;
    
    public function get() : int
    {
        return $this->value;
    }
    
    public function getDateTime() : \DateTime
    {
        $ts = $this->value >> self::TIMESTAMP_BIT_SIZE;
        $time = $ts + self::DISCORD_UNIX_EPOCH;
        $time = (float) $time/1000;

        return \DateTime::createFromFormat('U.u', (string) $time);
    }
    
    public function __toString() : string
    {
        return (string) $this->value;
    }
    
    private function validate(int $value) : void
    { 
        $size = mb_strlen((string) decbin($value));
        if ($size > self::BIT_MAX_SIZE) {
            throw InvalidSnowflakeException::sizeIsTooBig(self::BIT_MAX_SIZE, $size);
        }

        if ($value >> self::TIMESTAMP_BIT_SIZE <= 1000) {
            throw InvalidSnowflakeException::beforeDiscordUnixEpoch(self::BIT_MAX_SIZE, $size);
        }
    }
    
    public static function create(int $id) : Snowflake
    {
        return new self($id);
    }
    
    private function __construct(int $value)
    {
        $this->validate($value);
        $this->value = $value;
    }
}
