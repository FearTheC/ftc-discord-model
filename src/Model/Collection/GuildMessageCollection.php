<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\Collection;
use FTC\Discord\Model\Aggregate\GuildMessage;
use FTC\Discord\Model\ValueObject\Snowflake\MessageId;

class GuildMessageCollection implements Collection
{
    /**
     * @var GuildMessage[];
     */
    private $messages = [];
    
    public function __construct(GuildMessage ...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function getById(MessageId $id) : GuildMessage
    {
        return $this->messages[$id->get()];
    }
    
    public function add(GuildMessage $message)
    {
        $this->messages[(int) $message->getId()] = $message;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->messages);
    }
    
    
    public function toArray()
    {
        return $this->messages;
    }
    
    public function getIterator()
    {
        return $this->messages;
    }
}
