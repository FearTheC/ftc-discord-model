<?php
declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

class Snowflake
{
    const BIT_MAX_SIZE = 64;
    
    const TIMESTAMP_BIT_SIZE = 22;
    
    const DISCORD_UNIX_EPOCH = 1420070400000;
    
    const SIZE_EXCEEDED_MSG = "Snowflakes are up to %d bits in size, %d bits value provided";
    
    /**
     * @var int $value
     */
    private $value;
    
    public function __construct(int $value)
    {
        $this->value = $value;
        $this->validate();
    }
    
    public function get() : int
    {
        return $this->value;
    }
    
    public function getTime() : \DateTime
    {
        $ts = $this->value >> self::TIMESTAMP_BIT_SIZE;
        $time = $ts + self::DISCORD_UNIX_EPOCH;
        $time = $time/1000;

        return \DateTime::createFromFormat('U.u', (string) $time);
    }
    
    public function __toString() : string
    {
        return (string) $this->value;
    }
    
    private function validate()
    { 
        $size = mb_strlen((string) decbin($this->value));
        if ($size > self::BIT_MAX_SIZE)
        {
            throw new \Exception(sprintf(self::SIZE_EXCEEDED_MSG, self::BIT_MAX_SIZE, $size));
        }
    }
    
}
