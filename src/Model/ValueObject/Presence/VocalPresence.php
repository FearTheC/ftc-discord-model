<?php

declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject\Presence;

use FTC\Discord\Model\ValueObject\TimeSpan;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;

class VocalPresence extends TimeSpan
{
    
    /**
     * @var UserId
     */
    private $memberId;
    
    /**
     * @var ChannelId
     */
    private $channelId;
    
    private function __construct(UserId $memberId, ChannelId $channelId)
    {
        $this->memberId = $memberId;
        $this->channelId = $channelId;
        parent::__construct();
    }
    
    public function getMemberId() : UserId
    {
        return $this->memberId;
    }
    
    public function getChannelId() : ChannelId
    {
        
    }
    
    public static function create(UserId $memberId, ChannelId $channelId) : self
    {
        
        return new self($memberId, $channelId);
    }
    
}
