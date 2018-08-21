<?php

declare(strict_types=1);

namespace FTC\Discord\Container\Model\Service;

use Psr\Container\ContainerInterface;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\GuildChannelRepository;
use FTC\Discord\Model\Repository\VocalPresenceRepository;
use FTC\Discord\Model\Service\VocalPresenceService;

class VocalPresenceServiceFactory
{
    
    public function __invoke(ContainerInterface $container)
    {
        $vocalPresenceRepository = $container->get(VocalPresenceRepository::class);
        $guildMemberRepository = $container->get(GuildMemberRepository::class);
        $guildChannelRepository = $container->get(GuildChannelRepository::class);
        
        return new VocalPresenceService($vocalPresenceRepository, $guildMemberRepository, $guildChannelRepository);
    }
    
}
