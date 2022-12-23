<?php

namespace Slash686\McCaddyAskServer;

class DomainVerifier
{
    private array $blacklistedDomain = [
        'marketcall.ru',
        'marketcall.com',
    ];

    public function isValid(string $domain): bool
    {
        if (!$domain) {
            return false;
        }

        foreach ($this->blacklistedDomain as $blacklistedDomain) {
            if (\Slash686\str_ends_with($domain, $blacklistedDomain)) {
                return false;
            }
        }

        return true;
    }
}