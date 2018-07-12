<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake\RoleId;
use FTC\Discord\Model\ValueObject\Name\RoleName;
use FTC\Discord\Model\ValueObject\Color;
use FTC\Discord\Model\ValueObject\Permission;

class GuildRole
{
    /**
     * @var RoleId $id
     */
    private $id;
    
    /**
     * @var RoleName name
     */
    private $name;
    
    /**
     * @var Color $color
     */
    private $color;
    
    /**
     * @var Permission $permissions
     */
    private $permissions;
    
    /**
     * @var integer $position
     */
    private $position;
    
    /**
     * @var boolean $mentionable
     */
    private $mentionable;
    
    /**
     * @var boolean $hoist
     */
    private $hoist;
    
    
    private function __construct(RoleId $id, RoleName $name, Color $color, Permission $permissions, int $position, bool $mentionable, bool $hoist) {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->permissions = $permissions;
        $this->position = $position;
        $this->mentionable = $mentionable;
        $this->hoist = $hoist;
    }
    
    public function getName() : RoleName
    {
        return $this->name;
    }
    
    public function getPosition() : int
    {
        return $this->position;
    }
    
    public function isMentionable() : bool
    {
        return $this->mentionable;
    }
    
    public function isHoisted() : bool
    {
        return $this->hoist;
    }
    
    public function getHTMLColor() : string
    {
        return $this->color->getHTML();
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function can($value) : bool
    {
        return ($this->permissions->__toString() & $value) > 0;
    }
    
    public static function create(RoleId $id, RoleName $name, Color $color, Permission $permissions, int $position, bool $mentionnable, bool $hoist)
    {
        return new self($id, $name, $color, $permissions, $position, $mentionnable, $hoist);
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
