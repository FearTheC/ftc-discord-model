<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Collection;
use FTC\Discord\Model\Aggregate\Guild;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

class GuildCollection implements Collection
{
    /**
     * @var Guild[];
     */
    private $guilds = [];
    
    public function __construct(Guild ...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function add(Guild $guild)
    {
        $this->guilds[$guild->getId()->get()] = $guild;
        
        return $this;
    }
    
    public function getById(GuildId $guildId) : ?Guild
    {
        return $this->guilds[$guildId->get()];
    }
    
 
    public function count()
    {
        return count($this->guilds);
    }
    
    public function toArray()
    {
        return $this->guilds;
    }
    
    public function getIterator()
    {
        return $this->guilds;
    }
    
}
