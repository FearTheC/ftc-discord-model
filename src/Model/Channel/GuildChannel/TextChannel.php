<?php declare(strict_types=1);

namespace FTC\Discord\Model\Channel\GuildChannel;

use FTC\Discord\Model\ValueObject\Text\ChannelTopic;
use FTC\Discord\Model\ValueObject\Snowflake\CategoryId;
use FTC\Discord\Model\ValueObject\PermissionOverwrite;
use FTC\Discord\Model\ValueObject\Name\ChannelName;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\Channel\GuildChannel;
use FTC\Discord\Model\Collection\PermissionOverwriteCollection;

class TextChannel extends GuildChannel
{
    
    /**
     * @var ChannelTopic $topic
     */
    private $topic;
    
    private function __construct(
        ChannelId $id,
        ChannelName $name,
        int $position,
        PermissionOverwriteCollection$permissionOverwrites,
        CategoryId $categoryId = null,
        ChannelTopic $topic = null
    ) {
        $this->topic = $topic;
        parent::__construct($id, $name, $position, $permissionOverwrites, $categoryId);
    }
    
    public static function create(
        ChannelId $id,
        ChannelName $name,
        int $position,
        PermissionOverwriteCollection $permissionOverwrites,
        CategoryId $categoryId = null,
        ChannelTopic $topic = null
    ) : self {
        return new self($id, $name, $position, $permissionOverwrites, $categoryId, $topic);
    }
    
}
