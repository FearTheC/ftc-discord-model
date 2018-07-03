<?php
declare(strict_types=1);

namespace FTC\Discord\Model;

use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;

class GuildRole
{
    /**
     * @var RoleId $id
     */
    private $id;
    
    /**
     * @var string name
     */
    private $name;
    
    private function __construct(
        RoleId $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public static function create(RoleId $id, string $name)
    {
        return new self($id, $name);
    }
    
    public function toArray() : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'guild_id' => $this->guildId,
        ];
    }
    
    public static function fromDbRow(array $data)
    {
        return new GuildRole($data['id'], $data['name'], $data['guild_id']);
    }
    
}
