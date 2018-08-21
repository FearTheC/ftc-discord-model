<?php

declare(strict_types=1);

namespace FTC\Discord\Exception\Model\ValueObject;

class HashException extends \Exception
{
    
    const NOT_HEXADECIMAL = "Input is not an hexadecimal representation. Provided string is '%s'";
    
    public static function notHexa(string $value)
    {
        $msg = sprintf(
            self::NOT_HEXADECIMAL,
            $value
            );
        throw new self($msg);
    }
}
