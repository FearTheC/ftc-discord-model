<?php declare(strict_types=1);

namespace FTC\Discord\Exception\Model\ValueObject;

use FTC\Discord\Model\ValueObject\ChannelType;

class ChannelTypeException extends \Exception
{
    
    const BAD_TYPE_ID_MSG = "Channel type id should be an integer between %d and %d, %d provided.";
    
    public static function badTypeId(int $id)
    {
        $msg = sprintf(
            self::BAD_TYPE_ID_MSG,
            ChannelType::MINIMAL_VALUE,
            ChannelType::MAXIMAL_VALUE,
            $id
        );
        throw new self($msg); 
    }
}
