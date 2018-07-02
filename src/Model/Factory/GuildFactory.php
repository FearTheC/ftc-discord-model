<?php declare(strict_types=1);

namespace FTC\Discord\Model\Factory;

use FTC\Discord\Message;
use FTC\Discord\Model\GuildRole;
use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\Collection\GuildRoleCollection;

class GuildFactory
{
    
    public static function fromMessage(Message $message)
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
        
//         $roles = new GuildRoleCollection($message->getRoles());
        
    }
    
}
