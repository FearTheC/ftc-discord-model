<?php declare(strict_types=1);

namespace FTC\Discord\Model\Channel\GuildChannel;


use FTC\Discord\Model\ValueObject\Snowflake\CategoryId;
use FTC\Discord\Model\ValueObject\PermissionOverwrite;
use FTC\Discord\Model\ValueObject\Name\ChannelName;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\Channel\GuildChannel;
use FTC\Discord\Model\Collection\PermissionOverwriteCollection;

class Voice extends GuildChannel
{
    
    const TYPE = 2;
    
    /**
     * @var int $userLimit
     */
    private $userLimit;
    
    /**
     * @var int $bitrate
     */
    private $bitrate;
    
    private function __construct(
        ChannelId $id,
        ChannelName $name,
        int $position,
        PermissionOverwriteCollection $permissionOverwrites,
        CategoryId $categoryId = null,
        int $bitrate,
        int $userLimit
        ) {
            $this->bitrate = $bitrate;
            $this->userLimit = $userLimit;
            parent::__construct($id, $name, $position, $permissionOverwrites, $categoryId);
    }
    
    public static function create(
        ChannelId $id,
        ChannelName $name,
        int $position,
        PermissionOverwriteCollection $permissionOverwrites,
        CategoryId $categoryId = null,
        int $bitrate,
        int $userLimit
        ) : self {
            return new self($id, $name, $position, $permissionOverwrites, $categoryId, $bitrate, $userLimit);
    }
    
}
