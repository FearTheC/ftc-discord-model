<?php declare(strict_types=1);

namespace FTC\Discord\Model\ValueObject;


use FTC\Discord\Exception\Model\ValueObject\DomainName\InvalidDomainNameException;

class DomainName
{
    
    private $domain;
    
    private function __construct(string $domain)
    {
        $this->domain = $domain;
    }
    
    
    public function __toString() : string
    {
        return $this->domain;
    }
    
    
    public static function create(string $domainName)
    {
        $labels = explode('.', $domainName);
        
        if (count($labels) <= 1) {
            throw InvalidDomainNameException::missingLabels($domainName);
        }
        
        if (strlen($domainName) > 253) {
            throw InvalidDomainNameException::tooLong();
        }
        
        return new self($domainName);
    }
    
}
