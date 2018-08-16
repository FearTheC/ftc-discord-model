<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

interface GuildMemberRepository
{
    
    public function save(GuildMember $member, GuildId $guildId);
    
    public function delete(UserId $memberId, GuildId $guildId) : bool;
    
    public function getAll(GuildId $guildId) : GuildMemberCollection;
    
    public function findById(UserId $id) : GuildMember;
    
}
