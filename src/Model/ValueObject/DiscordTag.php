<?php declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

use FTC\Discord\Exception\Model\ValueObject\InvalidDiscordTagException;

class DiscordTag
{
    
    /**
     * @var int $tag
     */
    private $tag;
    
    public function __toString()
    {
        return (string) $this->tag;
    }
    
    
    private function __construct(string $tag)
    {
        if ((int) $tag < 0) {
            throw InvalidDiscordTagException::signedDigits($tag);
        }
        if (strlen((string) $tag) != 4) {
            throw InvalidDiscordTagException::badDigitsCount($tag);
        }
        
        $this->tag = (int) $tag;
    }
    
    public static function create(string $tag) : self
    {
        return new self($tag);
    }
    
}
