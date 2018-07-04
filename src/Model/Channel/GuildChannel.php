<?php declare(strict_types=1);

namespace FTC\Discord\Model\Channel;

use FTC\Discord\Model\Channel;
use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\ValueObject\Text\ChannelTopic;
use FTC\Discord\Model\ValueObject\PermissionOverwrite;
use FTC\Discord\Model\ValueObject\Snowflake\CategoryId;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Name\ChannelName;

abstract class GuildChannel extends Channel
{
    
    /**
     * @var CategoryId $categoryId
     */
    private $categoryId;
    
    /**
     * @var int $position
     */
    private $position;
    
    /**
     * @var PermissionOverwrite $permissionOverwrite
     */
    private $permissionOverwrite;
    
    /**
     * @var string $name
     */
    private $name;
    
    protected function __construct(
        ChannelId $id,
        ChannelName $name,
        int $position,
        PermissionOverwrite $permissionOverwrites = null,
        CategoryId $categoryId = null
    ) {
        $this->position = $position;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->permissionOverwrite = $permissionOverwrites;
        parent::__construct($id);
    }
    
}
