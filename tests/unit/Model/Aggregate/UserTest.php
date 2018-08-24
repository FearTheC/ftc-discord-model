<?php

declare(strict_types=1);

namespace FTC\Discord\Test\Model;

use PHPUnit\Framework\TestCase;
use FTC\Discord\Model\Aggregate\User;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Name\UserName;
use FTC\Discord\Model\ValueObject\DiscordTag;

final class UserTest extends TestCase
{
    
    /**
     * @dataProvider validUsersProvider
     */
    public function testCanBeRegistered($userId, $username, $tag)
    {
        $user = User::create($userId, $username, $tag);
        
        $this->assertInstanceOf(User::class, $user);
    }
    
   
    /**
     * @dataProvider validUsersProvider
     */
    public function testGetIdReturnsSnowflake($userId, $username, $tag)
    {
        $user = User::create($userId, $username, $tag);
        
        $this->assertEquals($userId, $user->getId());
    }
    
    
    /**
     * @dataProvider validUsersProvider
     */
    public function testGetUsernameReturnsSnowflake($userId, $username, $tag)
    {
        $user = User::create($userId, $username, $tag);
        
        $this->assertEquals($username, $user->getUsername());
    }
    
    
    public function validUsersProvider()
    {
        return [
            [
                UserId::create(123456789123456789),
                UserName::create('Joe'),
                DiscordTag::create('4563'),
            ],
        ];
    }
}
