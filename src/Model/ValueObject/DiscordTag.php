<?php declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

class DiscordTag
{
    
    /**
     * @var int $tag
     */
    private $tag;
    
    private function __construct(int $tag)
    {
        if ($tag < 0) {
            throw new Exception(sprintf("Discord Tags are negative numbers, %d provided", $tag));
        }
        if (strlen((string) $tag) != 4) {
            throw new Exception(sprintf("Discord Tags are exactly 4-digits numbers, %d provided", $tag));
        }
        
        $this->tag = $tag;
    }
    
    public static function create(int $tag) : self
    {
        return new self($tag);
    }
    
}
