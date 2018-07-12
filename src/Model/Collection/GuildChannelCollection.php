<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Aggregate\GuildChannel;
use FTC\Discord\Model\Collection;

class GuildChannelCollection implements Collection
{
    /**
     * @var Channel[];
     */
    private $channels;
    
    public function __construct(GuildChannel ...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function add(GuildChannel $channel)
    {
        $this->channels[] = $channel;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->channels);
    }
    
    
    public function toArray()
    {
        return $this->channels;
    }
}
