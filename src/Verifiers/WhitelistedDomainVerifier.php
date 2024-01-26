<?php

namespace Slash686\McCaddyAskServer\Verifiers;

use Slash686\McCaddyAskServer\Domain;
use Slash686\McCaddyAskServer\Database;

class WhitelistedDomainVerifier implements DomainVerifier
{
    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function isValid(Domain $domain): bool
    {
        $rows = $this->db->query('select id from domains where domain = ? limit 1;', [
            $domain->value(),
        ])->fetchAll();

        if (count($rows)) {
            return true;
        }

        return false;
    }
}