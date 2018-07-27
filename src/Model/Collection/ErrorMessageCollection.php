<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Collection;
use FTC\Discord\Model\Aggregate\ErrorMessage;

class ErrorMessageCollection implements Collection
{
    /**
     * @var ErrorMessage[];
     */
    private $errorMessages= [];
    
    public function __construct(ErrorMessage...$errorMessages)
    {
        array_map(['self', 'add'], $errorMessages);
    }
    
    public function getById(int $id) : ErrorMessage
    {
        return $this->errorMessages[$id];
    }
    
    public function add(ErrorMessage $errorMessage)
    {
        $this->errorMessages[$errorMessage->getId()] = $errorMessage;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->errorMessages);
    }
    
    
    public function toArray()
    {
        return $this->errorMessages;
    }
    
    public function getIterator()
    {
        return $this->errorMessages;
    }
}
