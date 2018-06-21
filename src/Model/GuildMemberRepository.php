<?php
namespace FTC\Discord\Model;

interface GuildMemberRepository
{
    
    public function add(GuildMember $member);
    
    public function remove(GuildMember $member);
    
    public function getAll() : array;
    
    public function findById(int $id) : GuildMember;
    
    public function getGuildMember(int $guildId, int $memberId) : ?GuildMember;
    
}
