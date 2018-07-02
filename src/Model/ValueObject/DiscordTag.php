<?php declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

use FTC\Discord\Exception\Model\ValueObject\InvalidDiscordTagException;

class DiscordTag
{
    
    /**
     * @var int $tag
     */
    private $tag;
    
    private function __construct(int $tag)
    {
        if ($tag < 0) {
            throw InvalidDiscordTagException::signedDigits($tag);
        }
        if (strlen((string) $tag) != 4) {
            throw InvalidDiscordTagException::badDigitsCount($tag);
        }
        
        $this->tag = $tag;
    }
    
    public static function create(int $tag) : self
    {
        return new self($tag);
    }
    
}
