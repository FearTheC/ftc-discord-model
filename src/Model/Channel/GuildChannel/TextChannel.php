<?php declare(strict_types=1);

namespace FTC\Discord\Model\GuildChannel;

use FTC\Discord\Model\GuildChannel;
use FTC\Discord\Model\ValueObject\Text\ChannelTopic;
use FTC\Discord\Model\ValueObject\Snowflake\CategoryId;
use FTC\Discord\Model\ValueObject\PermissionOverwrite;
use FTC\Discord\Model\ValueObject\Name\ChannelName;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;

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
        PermissionOverwrite $permissionOverwrite = null,
        CategoryId $categoryId,
        ChannelTopic $topic
    ) {
        $this->topic = $topic;
        parent::__construct($id, $name, $position, $permissionOverwrites, $category);
    }
    
    public static function create(
        ChannelId $id,
        ChannelName $name,
        int $position,
        PermissionOverwrite $permissionOverwrite = null,
        CategoryId $category = null,
        ChannelTopic $topic = null
    ) : self {
        return self($id, $name, $position, $permissionOverwrites, $category, $topic);
    }
    
}
