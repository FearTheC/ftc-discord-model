<?php declare(strict_types=1);

namespace FTC\Discord\Test\Model;

use PHPUnit\Framework\TestCase;
use FTC\Discord\Model\ValueObject\Email;
use FTC\Discord\Exception\Model\ValueObject\Email\InvalidEmailException;

final class EmailTest extends TestCase
{
    
    public function testCreationReturnsInstance()
    {
        $string = 'john@doh.com';
        $email = Email::create($string);
        
        $this->assertInstanceOf(Email::class, $email);
    }
    
    public function testInvalidEmailThrowsException()
    {
        $this->expectException(InvalidEmailException::class);
        $string = "john.doh.com";
        
        $email = Email::create($string);
    }
    
    public function testGet()
    {
        $string = 'john@doh.com';
        $email = Email::create($string);
        
        $this->assertEquals($string, $email->get());
    }
    
    public function test__toString()
    {
        $string = 'john@doh.com';
        $email = Email::create($string);
        
        $this->assertEquals($string, $email->__toString());
    }
    
}
