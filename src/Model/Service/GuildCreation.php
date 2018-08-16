<?php declare(strict_types=1);

namespace FTC\Discord\Model\Service;

use FTC\Discord\Model\Aggregate\GuildRepository;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\GuildRoleRepository;
use FTC\Discord\Model\Aggregate\GuildChannelRepository;
use FTC\Discord\Model\Aggregate\Guild;
use FTC\Discord\Model\Collection\GuildRoleCollection;
use FTC\Discord\Model\Collection\GuildMemberCollection;
use FTC\Discord\Model\Collection\GuildChannelCollection;
use FTC\Discord\Model\Aggregate\GuildWebsitePermissionRepository;
use FTC\Discord\Model\Aggregate\GuildWebsitePermission;
use FTC\Discord\Model\ValueObject\Snowflake\RoleId;

class GuildCreation
{
    
    const ROUTES_TO_ALLOW = [
        'home',
        'login',
        'logout',
    ];
    
    /**
     * @var GuildRepository $guildRepository
     */
    private $guildRepository;
    
    /**
     * @var GuildMemberRepository $guildMemberRepository
     */
    private $guildMemberRepository;
    
    /**
     * @var GuildRoleRepository $guildRoleRepository
     */
    private $guildRoleRepository;
    
    /**
     * @var GuildChannelRepository $guildChannelRepository
     */
    private $guildChannelRepository;
    
    /**
     * @var GuildWebsitePermissionRepository
     */
    private $websitePermissionRepository;
    
    
    public function __construct(
        GuildRepository $guildRepository,
        GuildMemberRepository $guildMemberRepository,
        GuildRoleRepository $guildRoleRepository,
        GuildChannelRepository $guildChannelRepository,
        GuildWebsitePermissionRepository $websitePermissionRepository
    ) {
        $this->guildRepository = $guildRepository;
        $this->guildMemberRepository = $guildMemberRepository;
        $this->guildRoleRepository = $guildRoleRepository;
        $this->guildChannelRepository = $guildChannelRepository;
        $this->websitePermissionRepository = $websitePermissionRepository;
    }
    
    
    public function __invoke(
        Guild $guild,
        GuildRoleCollection $roles,
        GuildMemberCollection $members,
        GuildChannelCollection $channels
     ) {
        if ($knownGuildState = $this->guildRepository->findById($guild->getId())) {
            $this->deleteMissingElements($guild, $knownGuildState);
        }
        $this->guildRepository->save($guild);
        $this->saveElements($guild, $roles, $members, $channels);
        
        array_map(
            function ($routeToPermit) use ($guild) {
                $roleId = RoleId::create((int) (string) $guild->getId());
                $permission = new GuildWebsitePermission($guild->getId(), $roleId, $routeToPermit);
                $this->websitePermissionRepository->save($permission);
            },
            self::ROUTES_TO_ALLOW
        );
    }
    
    private function saveElements(
        Guild $guild,
        GuildRoleCollection $roles,
        GuildMemberCollection $members,
        GuildChannelCollection $channels
    ) : void {
        array_map(
            [$this->guildRoleRepository, 'save'],
            $roles->getIterator(),
            array_fill(0, $roles->count(), $guild->getId())
            );
        
        array_map(
            [$this->guildMemberRepository, 'save'],
            $members->getIterator(),
            array_fill(0, $members->count(), $guild->getId())
            );
        
        array_map(
            [$this->guildChannelRepository, 'save'],
            $channels->getIterator(),
            array_fill(0, $channels->count(), $guild->getId())
            );
    }
    
    private function deleteMissingElements(Guild $newGuildState, Guild $knownGuildState) : void
    {
        array_map(
            [$this->guildRoleRepository, 'delete'],
            $newGuildState->getRoles()->getHasNot($knownGuildState->getRoles())->getIterator()
            );
        array_map(
            [$this->guildChannelRepository, 'delete'],
            $newGuildState->getChannels()->getHasNot($knownGuildState->getChannels())->getIterator()
            );
        array_map(
            [$this->guildMemberRepository, 'delete'],
            $newGuildState->getMembers()->getHasNot($knownGuildState->getMembers())->getIterator(),
            array_fill(0, $newGuildState->getMembers()->count(), $knownGuildState->getId())
            );
    }
    
}
