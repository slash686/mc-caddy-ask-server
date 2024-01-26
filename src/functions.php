<?php

namespace Slash686;

function str_ends_with(string $haystack, string $needle): bool
{
    $length = mb_strlen($needle);

    if (!$length) {
        return true;
    }

    return substr($haystack, -$length) === $needle;
}

function str_starts_with(string $haystack, string $needle): bool
{
    return strpos($haystack, $needle) === 0;
}

function json_response(array $data, int $httpCode = 200): void
{
    http_response_code($httpCode);

    header('Content-Type: application/json; charset=utf-8');

    echo json_encode($data, JSON_THROW_ON_ERROR);
}

function dd(...$vars): void
{
    foreach ($vars as $var) {
        var_dump($var);
    }

    die();
}