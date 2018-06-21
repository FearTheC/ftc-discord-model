<?php
namespace FTC\Discord\Model;

class GuildMember
{
    
    private $username;
    
    private $id;
    
    /**
     * @var GuildRole[]
     */
    private $roles;
    
    private function __construct(int $id, string $username, array $roles = null)
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
        $roles = array_map(function($obj) { return $obj->toArray(); }, $this->roles);
        return [
            'id' => $this->id,
            'username' => $this->username,
            'roles' => $roles,
        ];
    }
    
    public static function fromDb(array $data) : GuildMember
    {
        return new GuildMember($data['id'], $data['username'], $data['roles']);
    }
    
}
