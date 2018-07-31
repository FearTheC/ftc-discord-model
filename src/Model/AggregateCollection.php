<?php

declare(strict_types=1);

namespace FTC\Discord\Model;

interface AggregateCollection extends Collection
{
    
    public function getIds() : IdsCollection;
    
}
