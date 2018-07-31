<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Collection;
use FTC\Discord\Model\IdsCollection;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

class GuildIdCollection implements IdsCollection
{
    /**
     * @var GuildId[];
     */
    private $guildsIds = [];
    
    public function __construct(GuildId ...$guildsIds)
    {
        array_map(['self', 'add'], $guildsIds);
    }
    
    public function add(GuildId $guildsIds)
    {
        $this->guildsIds[$guildsIds->get()] = $guildsIds;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->guildsIds);
    }
    
    public function getIterator() : array
    {
        return $this->guildsIds;
    }
    
    public function toArray()
    {
        return array_map(function($guildId) { return $guildId->get(); }, $this->guildsIds);
    }
}
