<?php declare(strict_types=1);

namespace FTC\Discord\Model\Channel;

use FTC\Discord\Model\Channel;
use FTC\Discord\Model\ValueObject\Snowflake;
use FTC\Discord\Model\Collection\UserCollection;

abstract class DMChannel extends Channel
{
    /**
     * @var Snowflake $ownerId;
     */
    private $ownerId;
    
    /**
     * @var UserCollection $recipients 
     */
    private $recipients;
}
