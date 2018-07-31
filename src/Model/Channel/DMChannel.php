<?php declare(strict_types=1);

namespace FTC\Discord\Model\Channel;

use FTC\Discord\Model\Channel;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\Collection\UserIdCollection;
use FTC\Discord\Model\Aggregate\GuildChannel;

abstract class DMChannel extends GuildChannel
{
    
    /**
     * @var UserIdCollection
     */
    protected $recipientsId;
    
    
    protected function __construct(ChannelId $id, UserIdCollection $recipientsId)
    {
        $this->recipientsId = $recipientsId;
        parent::__construct($id);
    }
    
}
