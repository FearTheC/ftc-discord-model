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
    
    public function fromMessage(Message $message)
    {
        $guildId = Snowflake::create($message->getId());
        $ownerId = Snowflake::create($message->getOwnerId());
        
        $rolesArray = array_map(
            function($value) {
                $id = Snowflake::create((int) $value['id']);
                return GuildRole::create($id, $value['name']);
            },
            $message->getRoles());
        $guildRoles = new GuildRoleCollection(...$rolesArray);
        
        $membersArray = array_map(
            function($value) use ($guildRoles, $guildId) {
                $id = Snowflake::create((int) $value['user']['id']);
                $user = User::create($id, $value['user']['username']);
                $nickname = $value['nickname'] ?? null;
                
                $roles = $guildRoles->filterByIds($value['roles']);
                
                return GuildMember::create($guildId, $user, $roles, $nickname);
            },
            $message->getMembers());
        $members = new GuildMemberCollection(...$membersArray);
        

        
        return  Guild::create($guildId, $message->getGuildName(), $ownerId, $guildRoles, $members);
    }
    
}
