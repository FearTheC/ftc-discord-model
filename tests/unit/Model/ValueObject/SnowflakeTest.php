<?php declare(strict_types=1);

namespace FTC\Discord\Test\Model;

use PHPUnit\Framework\TestCase;
use FTC\Discord\Model\ValueObject\Email;
use FTC\Discord\Exception\Model\ValueObject\Snowflake\InvalidSnowflakeException;
use FTC\Discord\Model\ValueObject\Snowflake;

/**
 * @covers Snowflake::
 */
final class SnowflakeTest extends TestCase
{

    const MAX_64_BITS_NUMBER = 9223372036854775807;
    
    /**
     * @covers Snowflake::create
     */
    public function testCreationReturnsInstance()
    {
        $id = self::MAX_64_BITS_NUMBER;
        $email = Snowflake::create($id);
        
        $this->assertInstanceOf(Snowflake::class, $email);
    }
    
    /**
     * @covers Snowflake::create
     */
    public function testSnowflakeIsPreDiscordUnixEpochThrowsException()
    {
        $this->expectException(InvalidSnowflakeException::class);
        
        $datetime = new \DateTime('2015-01');
        $TSinMs = $datetime->format('Uu')/1000;
        $TsSinceDiscord = $TSinMs - 1420070400000;
        $id = $TsSinceDiscord << 22;
        $email = Snowflake::create($id);
    }
    
    /**
     * @covers Snowflake::get
     */
    public function testGet()
    {
        $id = self::MAX_64_BITS_NUMBER;
        $email = Snowflake::create($id);
        
        $this->assertEquals($id, $email->get());
    }
    
    /**
     * @covers Snowflake::getDateTime
     */
    public function testGetDateTimeReturnsDateTimeObject()
    {
        $id = self::MAX_64_BITS_NUMBER;
        $snowflake = Snowflake::create($id);
        
        $this->assertInstanceOf(\DateTime::class, $snowflake->getDateTime());
    }
    
    /**
     * @covers Snowflake::getDateTime
     */
    public function testGetDateTimeReturnsCorrectTime()
    {
        $datetime = new \DateTime();
        $TSinMs = $datetime->format('Uu')/1000;
        $TsSinceDiscord = $TSinMs - 1420070400000;
        $id = $TsSinceDiscord << 22;
        $snowflake = Snowflake::create($id);
         
        $this->assertEquals(
            $datetime->getTimestamp(),
            $snowflake->getDateTime()->getTimestamp()
        );
    }

    public function test__toString()
    {
        $id = self::MAX_64_BITS_NUMBER;
        $email = Snowflake::create($id);
        
        $this->assertEquals((string) $id, $email->__toString());
    }
    
}
