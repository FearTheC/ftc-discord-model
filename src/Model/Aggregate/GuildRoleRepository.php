<?php declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;

interface GuildRoleRepository
{
    public function save(GuildRole $member);
    
    public function getAll() : array;
    
    public function findById(int $id) : GuildRole;
    
    public function findByName(string $name, int $guildId) : ?GuildRole;
    
}