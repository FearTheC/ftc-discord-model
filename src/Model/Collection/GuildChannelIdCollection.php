<?php declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\Collection;

class GuildChannelIdCollection implements Collection
{
    /**
     * @var RoleId[];
     */
    private $channelsIds = [];
    
    public function __construct(ChannelId ...$channelsIds)
    {
        array_map(['self', 'add'], $channelsIds);
    }
    
    public function add(ChannelId $channelsIds)
    {
        $this->channelsIds[] = $channelsIds;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->channelsIds);
    }
    
    public function getIterator() : array
    {
        return $this->channelsIds;
    }
    
    public function toArray()
    {
        return array_map(function($roleId) { return $roleId->get(); }, $this->channelsIds);
    }
}
