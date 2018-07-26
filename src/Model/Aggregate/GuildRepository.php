<?php
namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\ValueObject\DomainName;
use FTC\Discord\Model\Collection\GuildCollection;

interface GuildRepository
{
    
    public function save(Guild $guild);
    
    public function getAll() : GuildCollection;
    
    public function findById(GuildId $id) : ?Guild;
    
    public function findByDomainName(DomainName $domainName) : ?Guild;
    
}