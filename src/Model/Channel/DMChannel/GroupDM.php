<?php declare(strict_types=1);

namespace FTC\Discord\Model\GuildChannel;

use FTC\Discord\Model\Channel\DMChannel;

class GroupDM extends DMChannel
{
    
    /**
     * @var int $typeId
     */
    private $typeId = self::GROUP_DM;
    
}
