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
    
    /**
     * @var int $maxSize
     */
    private $maxSize = null;
    
    /**
     * @var int $minSize
     */
    private $minSize = null;
    
    private function __construct(string $value)
    {
        $value = trim($value);
        $strLen = strlen($value);
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
    
    public function __toString()
    {
        return $this->value;
    }
    
}
