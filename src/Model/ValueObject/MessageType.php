<?php

declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;


use FTC\Discord\Exception\Model\ValueObject\InvalidMessageTypeException;

class MessageType
{
    
    const DEFAULT = 0;
    const RECIPIENT_ADD = 1;
    const RECIPIENT_REMOVE = 2;
    const CALL = 3;
    const CHANNEL_NAME_CHANGE = 4;
    const CHANNEL_ICON_CHANGE = 5;
    const CHANNEL_PINNED_MESSAGE = 6;
    const GUILD_MEMBER_JOIN = 7;
    
    const MAX_TYPE_INT = 7;

    const MIN_TYPE_INT = 1;
    
    
    /**
     * @var int 
     */
    private $value;
    
    private function __construct(int $value)
    {
        $this->value = $value;
    }
    
    public static function create(int $type)
    {
        if ($type < self::MIN_TYPE_INT && $type > self::MAX_TYPE_INT) {
            throw InvalidMessageTypeException::invalidType($type);
        }
        return new self($type);
    }
    
    public function __toString() : string
    {
        return (string) $this->value;
    }
    
}
