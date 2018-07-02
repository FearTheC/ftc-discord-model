<?php declare(strict_types=1);

namespace FTC\Discord\Container\Model;

use FTC\Discord\Message;
use FTC\Discord\Model\GuildRole;
use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTC\Discord\Model\User;
use FTC\Discord\Model\GuildMember;
use FTC\Discord\Model\Guild;

class GuildFactory
{
    
    public function __invoke()
    {
        $guildId = $message->getGuildId();
        $coll = new GuildRoleCollection();
        $roles = array_map(function($value) use ($guildId, $coll) {
            $id = Snowflake::create((int) $value['id']);
            $role = GuildRole::create($id, $value['name']);
            $coll->add($role);
        },
        $message->getRoles());
            var_dump($coll->count());
            var_dump($container);
    }
    
    public function fromMessage(Message $message)
    {
        $guildId = Snowflake::create($message->getGuildId());
        $ownerId = Snowflake::create($message->getOwnerId());
        $guildRoles = new GuildRoleCollection();
        array_map(
            function($value) use ($guildRoles) {
                $id = Snowflake::create((int) $value['id']);
                $role = GuildRole::create($id, $value['name']);
                $guildRoles->add($role);
            },
            $message->getRoles());
        
        $members = new GuildMemberCollection();
        array_map(
            function($value) use ($members, $guildRoles) {
                $id = Snowflake::create((int) $value['user']['id']);
                $user = User::create($id, $value['user']['username']);
                $nickname = $value['nickname'] ?? null;
                
                $roles = $guildRoles->filterByIds($value['roles']);
                
                $member = GuildMember::create($user, $roles, $nickname);
                $members->add($member);
            },
            $message->getMembers());
        
        return  Guild::create($guildId, $message->getGuildName(), $ownerId, $guildRoles, $members);
    }
    
}
