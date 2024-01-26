<?php

namespace Slash686\McCaddyAskServer;

use InvalidArgumentException;

class Domain
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        if ($value === '') {
            throw new InvalidArgumentException("Empty domain value provided.");
        }

        $this->value = $value;
    }

    public static function fromString(string $value)
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}