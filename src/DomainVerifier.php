<?php

namespace Slash686\McCaddyAskServer;

class DomainVerifier
{
    private $blacklistedDomains = [
        'marketcall.ru',
        'marketcall.com',
    ];

    public function isValid(string $domain): bool
    {
        if (!$domain) {
            return false;
        }

        foreach ($this->blacklistedDomains as $blacklistedDomain) {
            if (\Slash686\str_ends_with($domain, $blacklistedDomain)) {
                return false;
            }
        }

        return true;
    }
}