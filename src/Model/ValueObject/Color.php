<?php declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

class Color
{
    
    /**
     * @var string $email
     */
    private $red;
    
    /**
     * @var integer $green
     */
    private $green;
    
    /**
     * @var integer $blue
     */
    private $blue;    
    

    public function getHTML()
    {
        $colors = $this->toArray();
        $colors = array_map([$this, 'dec2hex'], $colors);
        
        return implode($colors);
    }
    
    public function getRGB() : array
    {
        return [
            'R' => $this->red,
            'G' => $this->green,
            'B' => $this->blue,
        ];
    }
    
    public function getInteger()
    {
        return $this->blue + ($this->green << 8) + ($this->red << 16);
    }
    
    private function toArray()
    {
        return [$this->red, $this->green, $this->blue];
    }
    
    private function dec2hex($value)
    {
        return str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
    }
    
    
    private function __construct(int $red, int $green, int $blue)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }
    
    public static function createFromInteger(int $value) : self
    {
        $red = ($value >> 16) & 0xFF;
        $green = ($value >> 8) & 0xFF;
        $blue = $value & 0xFF;
        
        return new self($red, $green, $blue);
    }
    
    public static function createFromRGB(int $red, int $green, int $blue) : self
    {
        $results = $this->validateRGB([$red, $green, $blue]);
        if (in_array(true, $results)) {
            throw new \Exception();
        }
        
        return new self($red, $green, $blue);
    }
    
    private function validateRGB(array $channels)
    {
        return array_map(function($value) {
                return ($value > 255 OR $value < 0);
            },
            $channels
        );
    }
    
}
