<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Aggregate\User;

class UserCollection
{
    /**
     * @var User[] $users;
     */
    private $users;
    
    public function __construct(User...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function add(User $user)
    {
        $this->users[$user->getId()->get()] = $user;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->users);
    }
    
    
    public function toArray()
    {
        return $this->users;
    }
}
