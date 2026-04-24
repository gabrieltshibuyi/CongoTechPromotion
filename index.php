<?php

declare(strict_types=1);

require __DIR__ . '/app/bootstrap.php';

use App\Core\Router;

$router = new Router($config['base_url']);

require ROOT_PATH . '/routes/web.php';

$router->dispatch($_SERVER['REQUEST_URI'] ?? '/', $_SERVER['REQUEST_METHOD'] ?? 'GET');