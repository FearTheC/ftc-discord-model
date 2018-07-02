<?php
declare(strict_types=1);

namespace FTC\Discord\Model;

use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\ValueObject\Snowflake;

class GuildMember
{
    /**
     * @var Snowflake $guildId
     */
    private $guildId;
    
    /**
     * @var User $user
     */
    private $user;
    
    /**
     * @var string $nickname?
     */
    private $nickname;
    
    /**
     * @var GuildRoleCollection $roles
     */
    private $roles;
    
    /**
     * @var \DateTime $joinedAt
     */
    private $joinedAt;
    
    private function __construct(Snowflake $guildId, User $user, GuildRoleCollection $roles = null, $nickname)
    {
        $this->guildId = $guildId;
        $this->user = $user;
        $this->roles = $roles;
        $this->nickname = $nickname;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function getId()
    {
        return $this->getUser()->getId();
    }
    
    public function getRoles()
    {
        return $this->roles;
    }
    
//     public static function register(User $user, string $nickname) : GuildMember
//     {  
//         $member = new GuildMember($user, $nickname);
//         return $member;
//     }
    
    public function toArray() : array
    {
        $roles = array_map(function($obj) { return $obj->toArray(); }, $this->roles->toArray());
        return [
            'user' => $this->user,
            'nickname' => $this->nickname,
            'roles' => $roles,
        ];
    }
    
    public static function create(Snowflake $guildId, User $user, GuildRoleCollection $roles, string $nickname = null)
    {
        return new self($guildId, $user, $roles, $nickname);
    }
    
    public static function fromDb(array $data) : GuildMember
    {
        $data['roles'] = json_decode($data['roles'], true);
        $data['roles'] = array_map([GuildRole::class, 'fromDbRow'], $data['roles']);
        $data['roles'] = new GuildRoleCollection(...$data['roles']);
        return new GuildMember(new Snowflake($data['user']), $data['nickname'], $data['roles']);
    }
    
}
