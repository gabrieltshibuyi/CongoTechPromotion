<?php

declare(strict_types=1);

require __DIR__ . '/../app/bootstrap.php';

use App\Core\Router;

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$publicPrefix = rtrim($config['base_url'] . '/public', '/');

if ($publicPrefix !== '' && str_starts_with($requestPath, $publicPrefix)) {
	$cleanPath = substr($requestPath, strlen($publicPrefix)) ?: '/';
	$queryString = $_SERVER['QUERY_STRING'] ?? '';

	header('Location: ' . $config['base_url'] . $cleanPath . ($queryString !== '' ? '?' . $queryString : ''), true, 301);
	exit;
}

$router = new Router($config['base_url']);

require ROOT_PATH . '/routes/web.php';

$router->dispatch($_SERVER['REQUEST_URI'] ?? '/', $_SERVER['REQUEST_METHOD'] ?? 'GET');
