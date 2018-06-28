<?php declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

use FTC\Discord\Exception\Model\ValueObject\ChannelTypeException;

class ChannelType
{
    const GUILD_TEXT = 0;
    const DM = 1;
    const GUILD_VOICE = 2;
    const GROUP_DM = 3;
    const GUILD_CATEGORY = 4;
    
    const MINIMAL_VALUE = self::GUILD_TEXT;
    const MAXIMAL_VALUE = self::GUILD_CATEGORY;
    
    /**
     * @var int $type;
     */
    private $type;
    
    private function __construct(int $type)
    {
        $this->validate($type);
        $this->type = $type;
    }
    
    public function isTextChannel() : bool
    {
        return in_array($this->type, [
            self::GUILD_TEXT,
            self::DM,
            self::GROUP_DM,
        ]);
    }
    
    public function isVoiceChannel() : bool
    {
        return in_array($this->type, [
            self::GUILD_VOICE,
        ]);
    }
    
    public static function create(int $type) : self
    {
        return new self($type);
    }
    
    public function validate(int $type) : void
    {
        if ($type < self::MINIMAL_VALUE or $type > self::MAXIMAL_VALUE) {
            throw ChannelTypeException::badTypeId($type); 
        }
    }
}
