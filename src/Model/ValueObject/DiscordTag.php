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
        return (string) str_pad((string) $this->tag, 4, '0');
    }
    
    
    private function __construct(string $tag)
    {
        if ((int) $tag < 0) {
            throw InvalidDiscordTagException::signedDigits((int) $tag);
        }

        if (strlen((string) $tag) != 4) {
            throw InvalidDiscordTagException::badDigitsCount((int) $tag);
        }
        
        $this->tag = (int) $tag;
    }
    
    public static function create(string $tag) : self
    {
        return new self($tag);
    }
    
}
