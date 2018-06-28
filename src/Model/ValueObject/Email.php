<?php declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

class Email
{
    
    /**
     * @var string $email
     */
    private $email;
    
    private function __construct(int $email)
    {
        if (filter_var($tag, FILTER_VALIDATE_EMAIL)) {
            throw new Exception(sprintf("Invalid email string, '%d' provided", $tag));
        }
        
        $this->email= $email;
    }
    
    public static function create(string $email) : self
    {
        return new self($email);
    }
    
}
