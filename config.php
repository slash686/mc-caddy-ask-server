<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'database' => [
        'driver' => 'sqlite',
        'database' => __DIR__ . '/database/ask-server.db',
    ],

    'domain-verifier' => [
        'blacklisted-domains' => [
            'marketcall.ru',
            'marketcall.com',
            'saveautocare.com',
            'plumbing-usa.org',
        ],
        'blacklisted-sub-domains' => [
            'git',
            'gitlab',
        ],
    ],

    'auth' => [
        'token' => $_ENV['AUTH_TOKEN'],
    ],
];
