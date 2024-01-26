<?php

namespace Slash686\McCaddyAskServer\Verifiers;

use Slash686\McCaddyAskServer\Domain;

interface DomainVerifier
{
    public function isValid(Domain $domain): bool;
}