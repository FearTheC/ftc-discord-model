<?php declare(strict_types=1);

namespace FTC\Discord\Model\Factory;

use FTC\Discord\Message;
use FTC\Discord\Model\GuildRole;

class GuildRoleFactory
{
    
    public static function fromMessage($message)
    {
        
//         $roles = array_map([GuildRole::class, 'fromDbRow'], $message->getRoles());
//         $roles = new GuildRoleCollection($message->getRoles());
        
    }
    
}
