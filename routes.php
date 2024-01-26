<?php

$router->get('/', 'controllers/index.php');
$router->get('/domains', 'controllers/index.php');
$router->post('/domains', 'controllers/store.php');