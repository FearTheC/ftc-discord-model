<?php declare(strict_types=1);

namespace FTC\Discord\Exception\Model\ValueObject\DomainName;

final class InvalidDomainNameException extends \InvalidArgumentException
{
    
    const MISSING_LABELS = "Domain names are made of at least two labels seperated by a dot (i.e. \"exemple.com\" or \"something.org\"). '%s' provided.";
    
    const TOO_LONG = "Domain names cannot consist of more than 253 characters.";
    
    
    public function __construct($message)
    {
        parent::__construct($message);
    }
    
    public static function missingLabels(string $domainName)
    {
        return new self(sprintf(self::MISSING_LABELS, $domainName));
    }
    
    public static function tooLong()
    {
        return new self(sprintf(self::TOO_LONG));
    }
    
    
    
}
