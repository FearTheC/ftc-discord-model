<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Channel\DMChannel;

use FTC\Discord\Model\Channel\DMChannel;

class GroupDM extends DMChannel
{
    
    /**
     * @var int $typeId
     */
    protected $typeId = self::GROUP_DM;
    
}
