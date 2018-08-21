<?php
declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

use FTC\Discord\Model\ModelObject;

class Text implements ModelObject
{
    
    const MAX_LENGTH = null;
    
    const MIN_LENGTH = null;
    
    /**
     * @var string $value
     */
    private $value;
    
    protected function __construct(string $value)
    {
        $value = trim($value);
        $strLen = mb_strlen($value);
        if (static::MAX_LENGTH && $strLen > static::MAX_LENGTH) {
            throw new \Exception();
        } 
        if (static::MIN_LENGTH && $strLen < static::MIN_LENGTH) {
            throw new \Exception();
        }

        $this->value = $value;
    }
    
    public static function create(string $value)
    {
        return new static($value);
    }
    
    public function getMaxLength() : int
    {
        return static::MAX_LENGTH;
    }
    
    public function getMinLength() : int
    {
        return static::MIN_LENGTH;
    }
    
    public function get() : string
    {
        return $this->value;
    }
    
    public function __toString() : string
    {
        return $this->value;
    }
    
}
