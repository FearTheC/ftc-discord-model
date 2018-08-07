<?php
declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

use FTC\Discord\Model\ModelObject;

class Name implements ModelObject
{
    
    const MAX_LENGTH = null;
    
    const MIN_LENGTH = null;
    
    const FORBIDDEN_CHARS = null;
    
    const FORBIDDEN_NAMES = null;
    
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
        $value = $this->removeExcessiveWhiteSpaces($value);
        $strLen = mb_strlen($value);
        
        if (static::MAX_LENGTH && $strLen > static::MAX_LENGTH) {
            throw new \Exception();
        } 
        if (static::MIN_LENGTH && $strLen < static::MIN_LENGTH) {
            throw new \Exception();
        }
        if ($culprits = $this->findForbiddenChars($value)) {
            throw new \Exception();
        }
        if (static::FORBIDDEN_NAMES && in_array($value, static::FORBIDDEN_NAMES)) {
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
    
    
    private function findForbiddenChars($value) : array {
        $culprits = [];
        if (static::FORBIDDEN_CHARS) {
            foreach (static::FORBIDDEN_CHARS as $forbiddenChar) {
                $lastPos = 0;
                while (($lastPos = strpos($value, $forbiddenChar, $lastPos)) !== false) {
                    $culprits[] = ['pos' => $lastPos, 'char' => $forbiddenChar];
                    $lastPos++;
                }
    
            }
        }
        return $culprits;
    }
    
    private function removeExcessiveWhiteSpaces($value)
    {
        return preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $value);
    }
}
