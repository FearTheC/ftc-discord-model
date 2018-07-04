<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Channel;

class GuildChannelCollection
{
    /**
     * @var Channel[];
     */
    private $channels;
    
    public function __construct(Channel ...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function add(Channel $channel)
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
