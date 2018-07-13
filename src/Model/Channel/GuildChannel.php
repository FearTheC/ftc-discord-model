<?php declare(strict_types=1);

namespace FTC\Discord\Model\Channel;

use FTC\Discord\Model\ValueObject\Snowflake\CategoryId;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Name\ChannelName;
use FTC\Discord\Model\Collection\PermissionOverwriteCollection;
use FTC\Discord\Model\Aggregate\GuildChannel as GuildChannelSup;

abstract class GuildChannel extends GuildChannelSup
{
    const POS_COEFF = [
        0 => 1,
        2 => 10,
        4 => 100,
    ];
    
    /**
     * @var CategoryId $categoryId
     */
    private $categoryId;
    
    /**
     * @var int $position
     */
    private $position;
    
    /**
     * @var PermissionOverwriteCollection $permissionOverwrites
     */
    private $permissionOverwrites;
    
    /**
     * @var ChannelName $name
     */
    private $name;
    
    protected function __construct(
        ChannelId $id,
        ChannelName $name,
        int $position,
        PermissionOverwriteCollection $permissionOverwrites,
        CategoryId $categoryId = null
    ) {
        $this->position = $position;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->permissionOverwrites = $permissionOverwrites;
        parent::__construct($id);
    }
    
    
    public function getName() : ChannelName
    {
        return $this->name;
    }
    
    public function getPosition() : int
    {
        return $this->position;
    }
    
    public function getPermissionOverwrites() : PermissionOverwriteCollection
    {
        return $this->permissionOverwrites;
    }
    
    public function getCategoryId() : ?ChannelId
    {
        return $this->categoryId;
    }
    
    public function getPositionnalBaseCoeff()
    {
        return self::POS_COEFF[$this->getTypeId()] * ($this->getPosition() + 1);
    }
    
}
