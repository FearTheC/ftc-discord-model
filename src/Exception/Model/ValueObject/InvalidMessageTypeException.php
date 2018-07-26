<?php

declare(strict_types=1);

namespace FTC\Discord\Exception\Model\ValueObject;

use FTC\Discord\Model\ValueObject\MessageType;

final class InvalidMessageTypeException extends \InvalidArgumentException
{
    
    const INVALID_TYPE = "Discord message are integers comprised between %d and %d, %d provided";
    
    
    public function __construct($message)
    {
        parent::__construct($message);
    }
    
    public static function invalidType(int $type)
    {
        return new self(sprintf(self::INVALID_TYPE, MessageType::MIN_TYPE_INT, MessageType::MAX_TYPE_INT, $type));
    }
    
}
