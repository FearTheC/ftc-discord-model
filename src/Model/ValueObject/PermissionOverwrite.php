<?php declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;

class PermissionOverwrite
{

    /**
     * @var Snowflake subjectId
     */
    private $subjectId;
    
    /**
     * @var integer $allow
     */
    private $allow;
    
    /**
     * @var integer $deny
     */
    private $deny;
    
    public function __construct(Snowflake $subjectId, int $allow, int $deny)
    {
       $this->subjectId = $subjectId;
       $this->allow = $allow;
       $this->deny = $deny;
    }
    
    public static function create(Snowflake $subjectId, int $allow, int $deny)
    {
        return new self($subjectId, $allow, $deny);
    }
    
    public function __toString()
    {
        return (string) $this->permisions;
    }
    
}
