<?php
declare(strict_types=1);

namespace FTC\Discord\Model;

use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\ValueObject\Email;
use FTC\Discord\Model\ValueObject\DiscordTag;

class User
{
    
    private $username;
    
    /**
     * @var Snowflake
     */
    private $id;
    
    /**
     * @var Email $email
     */
    private $email;
    
    /**
     * @var DiscordTag $tag
     */
    private $tag;
    
    
    private function __construct(
        Snowflake $id,
        string $username,
        Email $email = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getId() : Snowflake
    {
        return $this->id;
    }
    
    public static function create(
        Snowflake $id,
        string $username,
        Email $email = null) : User
    {  
        return new User($id, $username, $email);
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
    
    public static function fromArray(array $data) : User
    {
        return self::create(
            Snowflake::create($data['id']),
            $data['username'],
            Email::create($data['email']));
    }
    
}
