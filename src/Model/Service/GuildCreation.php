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

class GuildCreation
{
    
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
    
    public function __construct(
        GuildRepository $guildRepository,
        GuildMemberRepository $guildMemberRepository,
        GuildRoleRepository $guildRoleRepository,
        GuildChannelRepository $guildChannelRepository
    ) {
        $this->guildRepository = $guildRepository;
        $this->guildMemberRepository = $guildMemberRepository;
        $this->guildRoleRepository = $guildRoleRepository;
        $this->guildChannelRepository = $guildChannelRepository;
    }
    
    public function __invoke(
        Guild $guild,
        GuildRoleCollection $roles,
        GuildMemberCollection $members,
        GuildChannelCollection $channels
     ) {
        $this->guildRepository->save($guild);
        
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
    
}
