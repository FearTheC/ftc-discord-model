<?php

declare(strict_types=1);

namespace FTC\Discord\Container\Model\Service;

use Psr\Container\ContainerInterface;
use FTC\Discord\Model\Aggregate\GuildRepository;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\GuildRoleRepository;
use FTC\Discord\Model\Aggregate\GuildChannelRepository;
use FTC\Discord\Model\Service\GuildCreation;
use FTC\Discord\Model\Aggregate\GuildWebsitePermissionRepository;

class GuildCreationFactory
{
    
    public function __invoke(ContainerInterface $container)
    {
        $guildRepository = $container->get(GuildRepository::class);
        $guildMemberRepository = $container->get(GuildMemberRepository::class);
        $guildRoleRepository = $container->get(GuildRoleRepository::class);
        $guildChannelRepository = $container->get(GuildChannelRepository::class);
        $websitePermissionsRepository = $container->get(GuildWebsitePermissionRepository::class);
        
        return new GuildCreation($guildRepository, $guildMemberRepository, $guildRoleRepository, $guildChannelRepository, $websitePermissionsRepository);
    }
    
}
