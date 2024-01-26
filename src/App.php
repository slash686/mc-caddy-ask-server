<?php

namespace Slash686\McCaddyAskServer;

class App
{
    private static $container;
    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    public static function container(): Container
    {
        return static::$container;
    }
}