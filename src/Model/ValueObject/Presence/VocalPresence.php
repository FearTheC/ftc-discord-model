<?php

declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject\Presence;

use FTC\Discord\Model\ValueObject\TimeSpan;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Hash\MD5;

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
    
    /**
     * @var MD5 $sessionId
     */
    private $sessionId;
    
    private function __construct(UserId $memberId, ChannelId $channelId = null, MD5 $sessionId)
    {
        $this->memberId = $memberId;
        $this->channelId = $channelId;
        $this->sessionId = $sessionId;
        
        parent::__construct();
    }
    
    public function isActive() : bool
    {
        return (!$this->getEnd());
    }
    
    public function getMemberId() : UserId
    {
        return $this->memberId;
    }
    
    public function getChannelId() : ChannelId
    {
        return $this->channelId;
    }
    
    public function getSessionId() : MD5
    {
        return $this->sessionId;
    }
    
    public static function create(UserId $memberId, ChannelId $channelId, MD5 $sessionId) : self
    {
        return new self($memberId, $channelId, $sessionId);
    }
    
}
