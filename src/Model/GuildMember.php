<?php
declare(strict_types=1);

namespace FTC\Discord\Model;

use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\ValueObject\Snowflake;

class GuildMember
{
    
    private $username;
    
    /**
     * @var Snowflake
     */
    private $id;
    
    /**
     * @var GuildRole[]
     */
    private $roles;
    
    private function __construct(Snowflake $id, string $username, GuildRoleCollection $roles = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->roles = $roles;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getRoles()
    {
        return $this->roles;
    }
    
    public static function register(int $id, string $username) : GuildMember
    {  
        $member = new GuildMember($id, $username);
        return $member;
    }
    
    public function toArray() : array
    {
        $roles = array_map(function($obj) { return $obj->toArray(); }, $this->roles->toArray());
        return [
            'id' => $this->id,
            'username' => $this->username,
            'roles' => $roles,
        ];
    }
    
    public static function fromDb(array $data) : GuildMember
    {
        $data['roles'] = json_decode($data['roles'], true);
        $data['roles'] = array_map([GuildRole::class, 'fromDbRow'], $data['roles']);
        $data['roles'] = new GuildRoleCollection(...$data['roles']);
        return new GuildMember(new Snowflake($data['id']), $data['username'], $data['roles']);
    }
    
}
