<?php declare(strict_types=1);

namespace FTC\Discord\Model\Service;

use FTC\Discord\Model\Aggregate\GuildRepository;
use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\GuildRoleRepository;
use FTC\Discord\Model\Aggregate\GuildChannelRepository;
use FTC\Discord\Model\Aggregate\Guild;

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
    
    public function __invoke(Guild $guild)
    {
        $this->guildRepository->save($guild);
        
        
        array_map(
            [$this->guildRoleRepository, 'save'],
            $guild->getRoles()->toArray(),
            array_fill(0, $guild->getRoles()->count(), $guild->getId())
            );
        
        array_map(
            [$this->guildMemberRepository, 'save'],
            $guild->getMembers()->toArray(),
            array_fill(0, $guild->getMembers()->count(), $guild->getId())
            );
        
        array_map(
            [$this->guildChannelRepository, 'save'],
            $guild->getChannels()->toArray(),
            array_fill(0, $guild->getChannels()->count(), $guild->getId())
            );
    }
    
}
