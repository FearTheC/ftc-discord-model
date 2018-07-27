<?php

declare(strict_types=1);

namespace FTC\Discord\Model\Aggregate;

use FTC\Discord\Model\Collection\ErrorMessageCollection;

interface ErrorMessageRepository
{
    
    public function save(ErrorMessage $member);
    
    public function remove(ErrorMessage$member);
    
    public function getAll() : ErrorMessageCollection;
    
}
