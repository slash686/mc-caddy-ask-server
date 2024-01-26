<?php

namespace Slash686\McCaddyAskServer\Verifiers;

use Slash686\McCaddyAskServer\Domain;

class BlacklistedSubDomainVerifier implements DomainVerifier
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
        foreach ($this->blacklist as $blacklistedSubdomain) {
            if (\Slash686\str_starts_with($domain->value(), $blacklistedSubdomain . '.')) {
                return false;
            }
        }

        return true;
    }
}