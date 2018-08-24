<?php

declare(strict_types=1);

namespace FTC\Discord\Test\Model\ValueObject;

use PHPUnit\Framework\TestCase;
use FTC\Discord\Model\ValueObject\DiscordTag;
use FTC\Discord\Exception\Model\ValueObject\TimeSpanException;
use FTC\Discord\Model\ValueObject\TimeSpan;

/**
 * @covers DiscordTag::
 */
final class TimeSpanTest extends TestCase
{
    
    
    /**
     * @covers TimeSpan::__construct
     */
    public function testEndBeforeStartThrowsException()
    {
        $this->expectException(TimeSpanException::class);
        
        $end = new \DateTime();
        $start = new \DateTime();
        
        $ts = new TimeSpan($start, $end);
    }
    
    public function testGetIntervalReturnsCorrect()
    {
        $start = new \DateTime();
        $end = new \DateTime();
        
        $ts = new TimeSpan($start, $end);
        
        $this->assertEquals($end->diff($start), $ts->getInterval());
    }
    
    /**
     * @covers TimeSpan::getStart
     */
    public function testGetStartReturnsStartDateTime()
    {
        $start = new \DateTime();
        $end = new \DateTime();
        
        $ts = new TimeSpan($start, $end);
        
        $this->assertEquals($start, $ts->getStart());
    }
    
    /**
     * @covers TimeSpan::getEnd
     */
    public function testGetEndReturnsEndDateTime()
    {
        $start = new \DateTime();
        $end = new \DateTime();
        
        $ts = new TimeSpan($start, $end);
        
        $this->assertEquals($end, $ts->getEnd());
    }
    

    public function testStopNotStartedThrows()
    {
        $this->expectException(TimeSpanException::class);
        $ts = new TimeSpan();
        $ts->stop();
    }
    
    /**
     * @dataProvider overlapsesTestDataProvider
     */
    public function testOverlapsesWithResults($a, $b, $expected)
    {
        $this->assertEquals($expected, $a->overlapsesWith($b));
    }
    
    public function testStartProvidesDefault()
    {
        $ts = new TimeSpan();
        $ts->start();
        
        $this->assertInstanceOf(\DateTime::class, $ts->getStart());
    }
    public function testStopProvidesDefault()
    {
        $ts = new TimeSpan();
        $ts->start();
        $ts->stop();
        
        $this->assertInstanceOf(\DateTime::class, $ts->getEnd());
    }
    
    /**
     *
     * @covers TimeSpan::start()
     */
    public function testStartProvidesCorrectDefault()
    {
        $ts = new TimeSpan();
        $before = new \DateTime();
        $ts->start();
        $after = new \DateTime();
        
        $this->assertTrue($before < $ts->getStart() && $after > $ts->getStart());
    }
    
    /**
     *
     * @covers TimeSpan::stop()
     */
    public function testStopProvidesCorrectDefault()
    {
        $ts = new TimeSpan();
        $ts->start();
        $before = new \DateTime();
        $ts->stop();
        $after = new \DateTime();
        
        $this->assertTrue($before < $ts->getEnd() && $after > $ts->getEnd());
    }
    
    /**
     * 
     * @covers TimeSpan::start()
     */
    public function testAlreadyStartedThrowsOnStart()
    {
        $this->expectException(TimeSpanException::class);
        
        $start = new \DateTime();
        $end = new \DateTime();
        
        $ts = new TimeSpan($start, $end);
        
        $ts->start($start);
    }
    
    
    public function overlapsesTestDataProvider()
    {
        $first = new \DateTime();
        $second = new \DateTime();
        $third = new \DateTime();
        $fourth = new \DateTime();
        
        return [
            'no overlaps - A before B' => [
                new TimeSpan($first, $second),
                new TimeSpan($third, $fourth),
                false,
            ],
            'no overlaps - B before A' => [
                new TimeSpan($third, $fourth),
                new TimeSpan($first, $second),
                false,
            ],
            'overlaps - A before B' => [
                new TimeSpan($first, $third),
                new TimeSpan($second, $fourth),
                true,
            ],
            'overlaps - A before B' => [
                new TimeSpan($second, $fourth),
                new TimeSpan($first, $third),
                true,
            ],
            'overlaps - A inside B' => [
                new TimeSpan($second, $third),
                new TimeSpan($first, $fourth),
                true,
            ],
            'overlaps - B inside A' => [
                new TimeSpan($first, $fourth),
                new TimeSpan($second, $third),
                true,
            ],
            'overlaps - A starts before B' => [
                new TimeSpan($first, $third),
                new TimeSpan($second, $third),
                true,
            ],
            'overlaps - B starts before A' => [
                new TimeSpan($second, $third),
                new TimeSpan($first, $third),
                true,
            ],
            'overlaps - A ends before B' => [
                new TimeSpan($first, $third),
                new TimeSpan($first, $fourth),
                true,
            ],
            'overlaps - B ends before A' => [
                new TimeSpan($first, $fourth),
                new TimeSpan($first, $third),
                true,
            ],
            'overlaps - A equals B' => [
                new TimeSpan($first, $second),
                new TimeSpan($first, $second),
                true,
            ],
        ];
    }

}
