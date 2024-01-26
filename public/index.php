<?php

use Slash686\McCaddyAskServer\Logger;
use Slash686\McCaddyAskServer\Domain;
use Slash686\McCaddyAskServer\Database;
use Slash686\McCaddyAskServer\DomainVerifier;
use Slash686\McCaddyAskServer\Verifiers\BlacklistedDomainVerifier;
use Slash686\McCaddyAskServer\Verifiers\WhitelistedDomainVerifier;
use Slash686\McCaddyAskServer\Verifiers\BlacklistedSubDomainVerifier;
use function Slash686\json_response;

require __DIR__.'/../vendor/autoload.php';

if (!defined('STDOUT')) {
    define('STDOUT', fopen('php://stdout', 'wb'));
}

$config = require '../config.php';

$logger = new Logger();

if (!isset($_GET['domain'])) {
    json_response([
        'error' => [
            'message' => $message = 'Domain is not provided.',
        ],
    ], 422);

    $logger->log("Disallowed: $message");

    return;
}

try {
    $domain = Domain::fromString((string) $_GET['domain']);
} catch (InvalidArgumentException $exception) {
    json_response([
        'error' => [
            'message' => $message = 'Domain is empty.',
        ],
    ], 422);

    $logger->log("Disallowed: $message");

    return;
}

$domainVerifier = new DomainVerifier(
    new BlacklistedDomainVerifier($config['domain-verifier']['blacklisted-domains']),
    new BlacklistedSubDomainVerifier($config['domain-verifier']['blacklisted-sub-domains']),
    new WhitelistedDomainVerifier(
        new Database($config['database']),
    )
);

if (!$domainVerifier->isValid($domain)) {
    json_response([
        'error' => [
            'message' => $message = 'Domain is not allowed.',
        ],
    ], 400);

    $logger->log("Disallowed: $message - {$domain->value()}");

    return;
}

json_response([], 200);

$logger->log("Allowed - {$domain->value()}");
