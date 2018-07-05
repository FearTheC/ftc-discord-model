<?php
declare(strict_types=1);

namespace FTC\Discord\Model\Collection;

use FTC\Discord\Model\ValueObject\PermissionOverwrite;

class PermissionOverwriteCollection
{
    /**
     * @var PermissionOverwrite[];
     */
    private $permissionsOverwrites;
    
    public function __construct(PermissionOverwrite ...$array)
    {
        array_map(['self', 'add'], $array);
    }
    
    public function add(PermissionOverwrite $permissionOverwrites)
    {
        $this->permissionsOverwrites[] = $permissionOverwrites;
        
        return $this;
    }
    
    public function count()
    {
        return count($this->permissionOverwrites);
    }
    
    
    public function toArray() : array
    {
        return array_map(function($value) {
                return $value->toArray();
            },
            $this->permissionsOverwrites
        );
    }
    
    public function toJson()
    {
        if (!$this->permissionsOverwrites) {
            return json_encode([]);
        }
        return json_encode($this->toArray());
    }
}
