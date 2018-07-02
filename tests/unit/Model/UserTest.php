<?php declare(strict_types=1);

namespace FTC\Discord\Test\Model;

use PHPUnit\Framework\TestCase;
use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\User;

final class UserTest extends TestCase
{ 
    public function testCanBeRegistered()
    {
        $id = $this->createMock(Snowflake::class);
        $user = User::create($id, 'Joe');
        
        $this->assertInstanceOf(User::class, $user);
    }
    
    public function testCanBeCreatedFromArray()
    {
        $array = [
            'id' => 5956206959001600000,
            'username' => 'Joe',
            'email' => 'email@ftc.com',
        ];

        $user = User::fromArray($array);
        
        $this->assertInstanceOf(User::class, $user);
    }
    
    public function testGetIdReturnsSnowflake()
    {
        $snowflake = $this->createMock(Snowflake::class);
        $user = User::create($snowflake, 'Joe');
        
        $this->assertEquals($snowflake, $user->getId());
    }
    
    public function testGetUsernameReturnsSnowflake()
    {
        $snowflake = $this->createMock(Snowflake::class);
        $user = User::create($snowflake, 'Joe');
        
        $this->assertEquals('Joe', $user->getUsername());
    }
}
