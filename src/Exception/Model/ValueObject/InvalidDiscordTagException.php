<?php declare(strict_types=1);

namespace FTC\Discord\Exception\Model\ValueObject;

final class InvalidDiscordTagException extends \InvalidArgumentException
{
    
    const SIGNED_MSG = "Discord Tags are unsigned numbers, %d provided";
    
    const DIGIT_COUNT_MSG = "Discord Tags are exactly 4-digits numbers, %d provided";
    
    public function __construct($message)
    {
        parent::__construct($message);
    }
    
    public static function signedDigits(int $tag)
    {
        return new self(sprintf(self::SIGNED_MSG, $tag));
    }
    
    public static function badDigitsCount(int $tag)
    {
        return new self(sprintf(self::DIGIT_COUNT_MSG, $tag));
    }
}
