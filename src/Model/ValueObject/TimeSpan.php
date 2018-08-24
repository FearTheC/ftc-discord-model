<?php

declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

use FTC\Discord\Exception\Model\ValueObject\TimeSpanException;

class TimeSpan
{
    
    /**
     * @var \DateTime $start
     */
    private $start;
    
    /**
     * @var \DateTime $end
     */
    private $end;
    
    public function blah()
    {
        if (1 < 2) {
            return false;
        }
        
        return false;
    }
    
    public function __construct(\DateTime $start = null, \DateTime $end = null)
    {
        $this->checkStartNotAfterEnd($start, $end);
        $this->start = $start;
        $this->end = $end;
    }
    
    public function getInterval() : ?\DateInterval
    {
        if (!$this->end) {
            return null;
        }
        
        return $this->end->diff($this->start);
    }
    
    public function stop(\DateTime $end = null) : self
    {
        $this->checkAlreadyStarted();
        $this->checkNotStoppedAlready();
        $this->checkStartNotAfterEnd($this->start, $end);
        
        $this->end = $end ?: new \DateTime();
        
        return $this;
    }
    
    public function start(\DateTime $start = null) : self
    {
        $this->checkNotStartedAlready();
        $this->start = $start ?? new \DateTime();
        
        return $this;
    }
    
    public function getStart() : ?\DateTime
    {
        return $this->start;
    }
    
    public function getEnd() : ?\DateTime
    {
        return $this->end;
    }
    
    public function overlapsesWith(TimeSpan $b) : bool
    {
        if (!$this->start || !$b->getStart()) {
            return false;
        }
        
        if (!$this->end && !$b->getEnd()) {
            return true;
        }
        
        if ($this->end && $b->getEnd()) {
            if ($this->end <= $b->getStart() || $this->start >= $b->getEnd()) {
                return false;
            }
        }
        
        if ($this->end && $this->end <= $b->getStart() OR $b->getEnd() && $b->getEnd() <= $this->start)
        {
            return false;
        }
        
        return true;
    }
    
    private function checkStartNotAfterEnd(\DateTime $start = null, \DateTime $end = null) : void
    {
        $start = $start ?? $this->start ?? null;
        $end = $end ?? $this->end ?: null;

        if ($end && $start >= $end) {
            TimeSpanException::startAfterEnd($start, $end);
        }
    }
    
    private function checkNotStartedAlready()
    {
        if ($this->start) {
            TimeSpanException::alreadyStarted();
        }
    }
    
    private function checkNotStoppedAlready()
    {
        if ($this->end) {
            TimeSpanException::alreadyStopped();
        }
    }
    
    private function checkAlreadyStarted()
    {
        if (!$this->start) {
            TimeSpanException::notStarted();
        }
    }
}
