<?php

namespace Slash686\McCaddyAskServer;

class Logger
{
    public function log(string $message): void
    {
        fwrite(STDOUT, $message . "\n");
    }
}