<?php
declare(strict_types=1);

namespace FTC\Discord\Model;

class GuildRole
{
    private $id;
    
    private $name;
    
    private $guildId;
    
    private function __construct(
        int $id,
        string $name,
        int $guildId
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->guildId = $guildId;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getId()
    {
        return $this->id;
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
