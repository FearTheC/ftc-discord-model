<?php declare(strict_types=1);

namespace FTC\Discord\Model;

use FTC\Discord\Model\ValueObject\Snowflake;

interface UserRepository
{
    
    public function save(User $user);
    
    public function getAll() : array;
    
    public function findById(Snowflake $id) : ?User;
    
}