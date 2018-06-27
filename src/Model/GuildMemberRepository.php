<?php
declare(strict_types=1);

namespace FTC\Discord\Model;

use FTC\Discord\Model\Collection\GuildMemberCollection;

interface GuildMemberRepository
{
    
    public function add(GuildMember $member);
    
    public function remove(GuildMember $member);
    
    public function getAll() : GuildMemberCollection;
    
    public function findById(int $id) : GuildMember;
    
    public function getGuildMember(int $guildId, int $memberId) : ?GuildMember;
    
}
