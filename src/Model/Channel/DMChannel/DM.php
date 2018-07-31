<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Channel\DMChannel;

use FTC\Discord\Model\Collection\UserIdCollection;
use FTC\Discord\Model\Channel\DMChannel;
use FTC\Discord\Model\ValueObject\Snowflake\MessageId;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;

class DM extends DMChannel
{
    
    /**
     * @var int $typeId
     */
    protected $typeId = self::DM;
    
    /**
     * @var MessageId
     */
    private $lastMessageId;
    
    public function getRecipientId() : UserId
    {
        $array = $this->recipientsId->getIterator();
        return reset($array);
    }
    
    public function getLastMessageId() : MessageId
    {
        return $this->lastMessageId;
    }
    
    private function __construct(
        ChannelId $id,
        UserIdCollection $recipientsId,
        MessageId $lastMessageId
    ) {
        $this->lastMessageId = $lastMessageId;
        parent::__construct($id, $recipientsId);
    }

    public static function create(
        ChannelId $id,
        UserId $recipientsId,
        MessageId $lastMessageId
            ) : self {
                return new self($id, new UserIdCollection($recipientsId), $lastMessageId);
        }
        
}
