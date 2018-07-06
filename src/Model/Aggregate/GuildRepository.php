<?php
namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake\GuildId;

interface GuildRepository
{
    
    public function save(Guild $guild);
    
    public function getAll() : array;
    
    public function findById(GuildId $id) : ?Guild;
    
}