<?php

declare(strict_types=1);

namespace FTC\Discord\Exception\Model\ValueObject;

class TimeSpanException extends \InvalidArgumentException
{
    
    const START_BEFORE_END = "TimeSpan's start `%s` is not before its end `%s`.";
    
    const ALREADY_STARTED = "TimeSpan already started.";
    
    const NOT_STARTED = "TimeSpan cannot be stopped if not started yet.";
    
    const ALREADY_STOPPED = "TimeSpan already stopped.";
    
    public static function startAfterEnd(\DateTime $start, \DateTime $end)
    {
        $msg = sprintf(
            self::START_BEFORE_END,
            $start->format(\DateTime::RFC3339_EXTENDED),
            $end->format(\DateTime::RFC3339_EXTENDED)
        );
        throw new self($msg);
    }
    
    public static function alreadyStarted()
    {
        throw new self(self::ALREADY_STARTED);
    }
    
    public static function notStarted()
    {
        throw new self(self::NOT_STARTED);
    }
    
    public static function alreadyStopped()
    {
        throw new self(self::ALREADY_STOPPED);
    }
    
}
