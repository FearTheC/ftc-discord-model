<?php
declare(strict_types=1);

namespace FTC\Discord\Model;

use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Name\NickName;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

class GuildMember
{
    
    /**
     * @var UserId $user
     */
    private $userId;
    
    /**
     * @var NickName $nickname?
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
    
    private function __construct(UserId $userId, GuildRoleCollection $roles = null, \DateTime $joinedAt, NickName $nickname = null)
    {
        $this->userId = $userId;
        $this->roles = $roles;
        $this->nickname = $nickname;
        $this->joinedAt = $joinedAt;
    }
    
    public function getId() : UserId
    {
        return $this->userId;
    }
    
    public function getRoles() : GuildRoleCollection
    {
        return $this->roles;
    }
    
    public function getNickname() : ?NickName
    {
        return $this->nickname;
    }
    
    public function getJoinDate() : \DateTime
    {
        return $this->joinedAt;
    }
    
    public function toArray() : array
    {
        $roles = array_map(function($obj) { return $obj->toArray(); }, $this->roles->toArray());
        return [
            'user' => $this->user,
            'nickname' => $this->nickname,
            'roles' => $roles,
        ];
    }
    
    public static function create(UserId $userId, GuildRoleCollection $roles, \DateTime $joinedAt, NickName $nickname = null)
    {
        return new self($userId, $roles, $joinedAt, $nickname);
    }
    
    public static function fromDb(array $data) : GuildMember
    {
        $data['roles'] = json_decode($data['roles'], true);
        $data['roles'] = array_map([GuildRole::class, 'fromDbRow'], $data['roles']);
        $data['roles'] = new GuildRoleCollection(...$data['roles']);
        return new GuildMember(new UserId($data['user']), $data['nickname'], $data['roles']);
    }
    
}
