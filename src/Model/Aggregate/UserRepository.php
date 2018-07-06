<?php declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\ValueObject\Snowflake\UserId;

interface UserRepository
{
    
    public function save(User $user);
    
    public function getAll() : array;
    
    public function findById(UserId $id) : ?User;
    
}