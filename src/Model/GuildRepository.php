<?php
namespace FTC\Discord\Model;

interface GuildRepository
{
    
    public function save(Guild $guild);
    
    public function getAll() : array;
    
    public function findById(int $id) : ?Guild;
    
}