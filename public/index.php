<?php

use Slash686\McCaddyAskServer\Logger;
use Slash686\McCaddyAskServer\DomainVerifier;
use function Slash686\json_response;

require __DIR__.'/../vendor/autoload.php';

if (!defined('STDOUT')) {
    define('STDOUT', fopen('php://stdout', 'wb'));
}

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

$domain = (string) $_GET['domain'];

if (!mb_strlen($domain)) {
    json_response([
        'error' => [
            'message' => $message = 'Domain is empty.',
        ],
    ], 422);

    $logger->log("Disallowed: $message");

    return;
}

$domainVerifier = new DomainVerifier();

if (!$domainVerifier->isValid($domain)) {
    json_response([
        'error' => [
            'message' => $message = 'Domain is not allowed.',
        ],
    ], 400);

    $logger->log("Disallowed: $message - $domain");

    return;
}

json_response([], 200);

$logger->log("Allowed - $domain");
