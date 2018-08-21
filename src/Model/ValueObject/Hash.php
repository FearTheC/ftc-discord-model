<?php

declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

use FTC\Discord\Exception\Model\ValueObject\Email\InvalidEmailException;
use FTC\Discord\Exception\Model\ValueObject\HashException;

class Hash extends Text
{
    
    /**
     * @var string
     */
    private $hash;
    
    protected function __construct($hash)
    {
        $this->assertIsHex($hash);
        parent::__construct($hash);
    }
    
    private function assertIsHex($value) : void
    {
        if (!ctype_xdigit($value)) {
            HashException::notHexa($value);
        }
    }
    
}
