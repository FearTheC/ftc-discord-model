<?php declare(strict_types=1);

namespace FTC\Discord\Exception\Model\ValueObject\Email;

final class InvalidEmailException extends \InvalidArgumentException
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
