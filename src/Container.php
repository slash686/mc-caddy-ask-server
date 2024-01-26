<?php

namespace Slash686\McCaddyAskServer;

use InvalidArgumentException;

class Container
{
    private $bindings = [];
    public function bind(string $key, $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve(string $key)
    {
        if (!isset($this->bindings[$key])) {
            throw new InvalidArgumentException("Unresolvable key: {$key}.");
        }

        $resolver = $this->bindings[$key];

        return $resolver();
    }
}