<?php declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Email;
use FTC\Discord\Model\ValueObject\DiscordTag;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Name\UserName;

class User
{
    
    
    
    private $username;
    
    /**
     * @var UserId
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
    
    /**
     * @var boolean $isBot
     */
    private $isBot;
    
    
    private function __construct(
        UserId $id,
        UserName $username,
        DiscordTag $tag,
        Email $email = null,
        bool $isBot = false)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->tag = $tag;
        $this->isBot = $isBot;
    }
    
    public function getUsername()
    {
        return $this->username;
    }

    public function getTag() : DiscordTag
    {
        return $this->tag;
    }
    
    public function isBot()
    {
        return $this->isBot;
    }
    
    public function getId() : UserId
    {
        return $this->id;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public static function create(
        UserId $id,
        UserName $username,
        DiscordTag $tag,
        Email $email = null,
        bool $isBot = false) : User
    {  
        return new User($id, $username, $tag, $email, $isBot);
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
        $email = null;
        if (array_key_exists('email', $data)) {
            $email = new Email((string) $data['email']);
        }
        
        $isBot = false;
        if (array_key_exists('bot', $data)) {
            $isBot = $data['bot'];
        }
        
        return self::create(
            UserId::create((int) $data['id']),
            UserName::create((string) $data['username']),
            DiscordTag::create($data['discriminator']),
            $email,
            $isBot
            );
    }
    
}
