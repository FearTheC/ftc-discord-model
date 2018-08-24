<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Repository;

use FTC\Discord\Model\Collection\ErrorMessageCollection;
use FTC\Discord\Model\ValueObject\ErrorMessage;

interface ErrorMessageRepository
{
    
    public function save(ErrorMessage $member);
    
    public function remove(ErrorMessage$member);
    
    public function getAll() : ErrorMessageCollection;
    
}
