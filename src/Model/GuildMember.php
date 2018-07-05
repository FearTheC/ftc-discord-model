<?php
declare(strict_types=1);

namespace FTC\Discord\Model;

use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Name\NickName;
use FTC\Discord\Model\Collection\GuildRoleIdCollection;

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
     * @var GuildRoleIdCollection $rolesId
     */
    private $rolesId;
    
    /**
     * @var \DateTime $joinedAt
     */
    private $joinedAt;
    
    private function __construct(UserId $userId, GuildRoleIdCollection $rolesId= null, \DateTime $joinedAt, NickName $nickname = null)
    {
        $this->userId = $userId;
        $this->rolesId = $rolesId;
        $this->nickname = $nickname;
        $this->joinedAt = $joinedAt;
    }
    
    public function getId() : UserId
    {
        return $this->userId;
    }
    
    public function getRoles() : GuildRoleIdCollection
    {
        return $this->rolesId;
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
        return [
            'user' => $this->user,
            'nickname' => $this->nickname,
            'roles' => $rolesId,
        ];
    }
    
    public static function create(UserId $userId, GuildRoleIdCollection $roles, \DateTime $joinedAt, NickName $nickname = null)
    {
        return new self($userId, $roles, $joinedAt, $nickname);
    }
    
}
