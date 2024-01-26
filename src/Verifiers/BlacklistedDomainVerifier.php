<?php

namespace Slash686\McCaddyAskServer\Verifiers;

use Slash686\McCaddyAskServer\Domain;

class BlacklistedDomainVerifier implements DomainVerifier
{
    /**
     * @var array
     */
    private $blacklist;

    public function __construct(array $blacklist)
    {
        $this->blacklist = $blacklist;
    }

    public function isValid(Domain $domain): bool
    {
        foreach ($this->blacklist as $blacklistedDomain) {
            if (\Slash686\str_ends_with($domain->value(), $blacklistedDomain)) {
                return false;
            }
        }

        return true;
    }
}