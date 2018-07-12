<?php declare(strict_types=1);

namespace FTC\Discord\Model\Service;

use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\GuildRoleRepository;

class Statistics
{
    
    public function __construct(
        GuildMemberRepository $guildMemberRepository,
        GuildRoleRepository $guildRoleRepository
        
    ) {
        
    }
    
}
