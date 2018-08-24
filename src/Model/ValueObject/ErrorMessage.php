<?php

declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

use FTC\Discord\Model\ValueObject\Text;

class ErrorMessage
{
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var integer
     */
    private $code;
    
    /**
     * @var Text
     */
    private $errorMessage;
    
    /**
     * @var Text
     */
    private $file;
    
    /**
     * @var integer
     */
    private $line;
    
    /**
     * @var Text
     */
    private $context;
    
    /**
     * @var \DateTime 
     */
    private $time;
    
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getCode() : int
    {
        return $this->code;
    }
    
    public function getMessage() : Text
    {
        return $this->errorMessage;
    }
    
    public function getFile() : Text
    {
        return $this->file;
    }
    
    public function getLine() : int
    {
        return $this->line;
    }
    
    public function getLocation()
    {
        return sprintf('%s:%s', $this->file, $this->line);
    }
    
    public function getTime() : \DateTime
    {
        return $this->time;
    }
    
    public function getContext() : Text
    {
        return $this->context;
    }

    
    private function __construct(
        int $id = null,
        int $code,
        Text $errorMessage,
        Text $file,
        int $line,
        Text $context,
        \DateTime $time = null
        ) {
            $this->code = $code;
            $this->errorMessage = $errorMessage;
            $this->file = $file;
            $this->line = $line;
            $this->context = $context;
            $this->time = $time;
    }
    
    public static function createFromScalarTypes(
        int $id = null,
        int $code,
        string $errorMessage,
        string $file,
        int $line,
        string $context,
        $time = null
    ) {
        $errorMessage = Text::create($errorMessage);
        $file = Text::create($file);
        $context = Text::create($context);
        if (!$time) {
            $time = (new \DateTime())->format('c');
        }
        
        $time = new \DateTime($time);
        
        return new self($id, $code, $errorMessage, $file, $line, $context, $time);
    }
}
