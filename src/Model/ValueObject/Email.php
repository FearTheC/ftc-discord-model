<?php

declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

use FTC\Discord\Exception\Model\ValueObject\Email\InvalidEmailException;

class Email
{
    
    /**
     * @var string $email
     */
    private $email;
    
    
    public function get() : string
    {
        return $this->email;
    }
    
    public function __toString() : string
    {
        return $this->email;
    }
    
    
    private function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException(sprintf("Invalid email string, '%d' provided", $email));
        }
        
        $this->email = $email;
    }
    
    public static function create(string $email) : self
    {
        return new self($email);
    }
    
}
