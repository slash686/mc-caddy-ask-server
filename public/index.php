<?php

use Slash686\McCaddyAskServer\Router;
use Slash686\McCaddyAskServer\Database;

require __DIR__.'/../vendor/autoload.php';

if (!defined('STDOUT')) {
    define('STDOUT', fopen('php://stdout', 'wb'));
}

$container = new \Slash686\McCaddyAskServer\Container();

$container->bind(Database::class, function () {
    $config = require '../config.php';
    return new Database($config['database']);
});

\Slash686\McCaddyAskServer\App::setContainer($container);

$router = new Router();

require '../routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);