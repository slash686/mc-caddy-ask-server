<?php

namespace Slash686\McCaddyAskServer;


use Slash686\McCaddyAskServer\Verifiers\DomainVerifier as DomainVerifierContract;

class DomainVerifier
{
    /** @var DomainVerifier[] */
    private $verifiers;

    public function __construct(DomainVerifierContract ...$verifiers)
    {
        $this->verifiers = $verifiers;
    }

    public function isValid(Domain $domain): bool
    {
        foreach ($this->verifiers as $verifier) {
            if (!$verifier->isValid($domain)) {
                return false;
            }
        }

        return true;
    }
}