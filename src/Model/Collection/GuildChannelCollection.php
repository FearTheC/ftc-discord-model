<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Channel\GuildChannel;
use FTC\Discord\Model\Collection;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\AggregateCollection;
use FTC\Discord\Model\IdsCollection;

class GuildChannelCollection implements AggregateCollection
{
    /**
     * @var GuildChannel[];
     */
    private $channels = [];
    
    public function __construct(GuildChannel ...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function add(GuildChannel $channel)
    {
        $this->channels[$channel->getId()->get()] = $channel;
        
        return $this;
    }
    
    public function getById(ChannelId $channelId) : ?GuildChannel
    {
        return $this->channels[$channelId->get()];
    }
    
    public function getIds() : IdsCollection
    {
        $ids = array_map(ChannelId::create((int) $id), array_keys($this->channels));
        
        return new GuildChannelIdCollection(...$ids);
    }
    
    public function displayOrder()
    {
        $orderedChannels = $this->channels;
        usort($orderedChannels, function(GuildChannel $a, GuildChannel $b) {
            return $this->getChannelCoeffPosition($a) > $this->getChannelCoeffPosition($b);
        });
        
        return new self(...$orderedChannels);
    }
    
    public function orderByPosition()
    {
        $orderedChannels = $this->channels;
        usort($orderedChannels, function($a, $b) {
            return ($a->getPosition() > $b->getPosition());
        });
            
        return new self(...$orderedChannels);
    }
    
    public function count()
    {
        return count($this->channels);
    }
    
    public function toArray()
    {
        return $this->channels;
    }
    
    public function getIterator()
    {
        return $this->channels;
    }
    
    private function getChannelCoeffPosition(GuildChannel $channel)
    {
        $additionalCoeff = 0;
        if ($channel->getCategoryId()) {
            $additionalCoeff = 2 * $this->getById($channel->getCategoryId())->getPositionnalBaseCoeff();
        }
        if ($channel->getTypeId() == \FTC\Discord\Model\Aggregate\GuildChannel::GUILD_CATEGORY) {
            $additionalCoeff = $channel->getPositionnalBaseCoeff();
        }
        
        $additionalCoeff = $additionalCoeff * $this->count();
        
        return $channel->getPositionnalBaseCoeff() + $additionalCoeff;
    }
}
