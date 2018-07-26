<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake\MessageId;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Text\ChannelMessage;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\MessageType;

class GuildMessage
{
    
    /**
     * @var MessageId $id
     */
    private $id;
    
    /**
     * @var MessageType
     */
    private $type;
    
    /**
     * @var ChannelId
     */
    private $channelId;
    
    /**
     * @var UserId
     */
    private $authorId;
     
    /**
     * @var ChannelMessage 
     */
    private $content;
    
    /**
     * @var \DateTime
     */
    private $creationTime;
    
    /**
     * @var \DateTime
     */
    private $updateTime;
    
    /**
     * @var boolean
     */
    private $isPinned;
    
    
    
    /**
     * @param \DateTime $updateTime
     */
    public function __construct(
        MessageId $id,
        ChannelId $channelId,
        UserId $authorId,
        MessageType $type,
        ChannelMessage $content,
        \DateTime $creationTime,
        \DateTime $updateTime = null,
        bool $isPinned = false
    ) {
        $this->id = $id;
        $this->channelId = $channelId;
        $this->authorId = $authorId;
        $this->type = $type;
        $this->content = $content;
        $this->creationTime = $creationTime;
        $this->updateTime = $updateTime;
        $this->isPinned = $isPinned;
    }
    
    public function getId() : MessageId
    {
        return $this->id;
    }
    
    public function getChannelId() : ChannelId
    {
        return $this->channelId;
    }
    
    public function getAuthorId() : UserId
    {
        return $this->authorId;
    }
    
    public function getCreationTime() : \DateTime
    {
        return $this->creationTime;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function getUpdateTime() : ?\DateTime
    {
        return $this->updateTime;
    }
    
    public function getContent() : ChannelMessage
    {
        return $this->content;
    }
    
    public function isPinned() : bool
    {
        return $this->isPinned;
    }
    
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'guild_id' => $this->guildId,
        ];
    }
    
}
