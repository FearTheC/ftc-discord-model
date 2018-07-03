<?php
declare(strict_types=1);

namespace FTC\Discord\Model;

use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

interface GuildMemberRepository
{
    
    public function add(GuildMember $member);
    
    public function remove(GuildMember $member);
    
    public function getAll() : GuildMemberCollection;
    
    public function findById(UserId $id) : GuildMember;
    
    public function getGuildMember(GuildId $guildId, UserId $memberId) : ?GuildMember;
    
}
