<?php declare(strict_types=1);

namespace FTC\Discord\Test\Model;

use PHPUnit\Framework\TestCase;
use FTC\Discord\Model\ValueObject\DiscordTag;
use FTC\Discord\Exception\Model\ValueObject\InvalidDiscordTagException;

/**
 * @covers DiscordTag::
 */
final class DiscordTagTest extends TestCase
{
    
    /**
     * @covers Snowflake::create
     */
    public function testCreate()
    {
        $tag = '1234';
        $sut = DiscordTag::create($tag);
        $this->assertInstanceOf(DiscordTag::class, $sut);
    }
    
    /**
     * @covers Snowflake::create
     */
    public function testSignedTagThrowError()
    {
        $this->expectException(InvalidDiscordTagException::class);
        $tag = '-5647';
        DiscordTag::create($tag);
    }
    
    /**
     * @covers Snowflake::create
     */
    public function testInvalidDigitsCountThrowsException()
    {
        $this->expectException(InvalidDiscordTagException::class);
        $tag = '46521';
        DiscordTag::create($tag);
    }

}
