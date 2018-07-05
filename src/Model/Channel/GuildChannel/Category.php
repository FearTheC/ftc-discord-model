<?php declare(strict_types=1);

namespace FTC\Discord\Model\Channel\GuildChannel;


use FTC\Discord\Model\Channel\GuildChannel;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Name\ChannelName;
use FTC\Discord\Model\Collection\PermissionOverwriteCollection;
use FTC\Discord\Model\ValueObject\Snowflake\CategoryId;

class Category extends GuildChannel
{
    
    /**
     * @var int $typeId
     */
    protected $typeId = self::GUILD_CATEGORY;
    
    private function __construct(
        ChannelId $id,
        ChannelName $name,
        int $position,
        PermissionOverwriteCollection$permissionOverwrites,
        CategoryId $categoryId = null
        ) {
            parent::__construct($id, $name, $position, $permissionOverwrites, $categoryId);
    }
    
    public static function create(
        ChannelId $id,
        ChannelName $name,
        int $position,
        PermissionOverwriteCollection $permissionOverwrites,
        CategoryId $categoryId = null
        ) : self {
            return new self($id, $name, $position, $permissionOverwrites, $categoryId);
    }
    
}
