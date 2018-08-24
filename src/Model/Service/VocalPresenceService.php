<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Service;

use FTC\Discord\Model\Aggregate\GuildMemberRepository;
use FTC\Discord\Model\Aggregate\GuildChannelRepository;
use FTC\Discord\Model\Repository\VocalPresenceRepository;
use FTC\Discord\Model\ValueObject\Snowflake\UserId;
use FTC\Discord\Model\ValueObject\Snowflake\GuildId;
use FTC\Discord\Model\ValueObject\Snowflake\ChannelId;
use FTC\Discord\Model\ValueObject\Hash\MD5;
use FTC\Discord\Model\ValueObject\Presence\VocalPresence;

class VocalPresenceService
{
    
    /**
     * @var VocalPresenceRepository
     */
    private $vocalPresenceRepository;
    
    /**
     * @var GuildMemberRepository $guildMemberRepository
     */
    private $guildMemberRepository;
    
    /**
     * @var GuildChannelRepository $guildChannelRepository
     */
    private $guildChannelRepository;
    
    public function __construct(
        VocalPresenceRepository $vocalPresenceRepository,
        GuildMemberRepository $guildMemberRepository,
        GuildChannelRepository $guildChannelRepository
        ) {
            $this->vocalPresenceRepository = $vocalPresenceRepository;
            $this->guildMemberRepository = $guildMemberRepository;
            $this->guildChannelRepository = $guildChannelRepository;
    }
    
    public function update(UserId $memberId, GuildId $guildId, ChannelId $channelId = null, MD5 $sessionId, \DateTime $datetime)
    {
        $lastPresence = $this->vocalPresenceRepository->getLastPresence($memberId, $guildId);

        // Unkown channel join time, this presence is dropped right away 
        if (!$lastPresence && !$channelId) {
            return;
        }
        
        
        if ($lastPresence && $lastPresence->isActive() && $lastPresence->getChannelId() == $channelId) {
            return;
        }
        
        if ($lastPresence && $lastPresence->isActive() && $lastPresence->getChannelId() != $channelId) {
            $this->memberLeftChannel($lastPresence, $datetime);
        }
        
        if ($channelId) {
            $vp = VocalPresence::create($memberId, $channelId, $sessionId);
            $this->memberJoinedChannel($vp, $datetime);
        }
    }
    
    public function memberLeftChannel(VocalPresence $vp, \Datetime $datetime)
    {
        $vp->stop($datetime);
        $this->vocalPresenceRepository->save($vp);
    }
    
    public function memberJoinedChannel(VocalPresence $vp, \Datetime $datetime)
    {
        $vp->start($datetime);
        $this->vocalPresenceRepository->save($vp);
    }
    
}
