<?php

use Slash686\McCaddyAskServer\Domain;
use Slash686\McCaddyAskServer\Database;
use function Slash686\json_response;

$config = require '../config.php';

$container = \Slash686\McCaddyAskServer\App::container();

try {
    $post = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
} catch (JsonException $exception) {
    json_response([
        'error' => [
            'message' => $message = 'Invalid json payload.',
        ],
    ], 400);

    exit();
}

$authToken = $_SERVER['HTTP_X_AUTH_TOKEN'];

if (!$config['auth']['token'] || !$authToken || $authToken !== $config['auth']['token']) {
    json_response([
        'error' => [
            'message' => $message = 'Unauthorized.',
        ],
    ], 401);

    exit();
}

if (!isset($post['domain']) || !trim($post['domain'])) {
    json_response([
        'error' => [
            'message' => $message = 'Domain is not provided.',
        ],
    ], 422);

    exit();
}

try {
    $domain = Domain::fromString(trim($post['domain']));
} catch (InvalidArgumentException $exception) {
    json_response([
        'error' => [
            'message' => $message = 'Domain is invalid.',
        ],
    ], 422);

    exit();
}

/** @var Database $db */
$db = $container->resolve(Database::class);

$rows = $db->query('SELECT id FROM domains WHERE domain = ? LIMIT 1', [
    $domain->value(),
])->fetchAll();

if (count($rows)) {
    json_response([
        'error' => [
            'message' => $message = 'Duplicate domain.',
        ],
    ], 422);

    exit();
}

$db->query('INSERT INTO domains (domain, created_at) VALUES (?, ?)', [
    $domain->value(),
    (new DateTimeImmutable)->format('Y-m-d H:i:s')
]);

json_response([
    'data' => [
        'domain' => $domain->value(),
    ]
], 200);

exit();
