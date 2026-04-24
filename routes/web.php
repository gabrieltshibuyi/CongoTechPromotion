<?php

use App\Controllers\SiteController;

$router->get('/', [SiteController::class, 'home']);
$router->get('/accueil', [SiteController::class, 'home']);
$router->get('/about', [SiteController::class, 'about']);
$router->get('/qui-sommes-nous', [SiteController::class, 'about']);
$router->get('/contact', [SiteController::class, 'contact']);
$router->post('/contact', [SiteController::class, 'submitContact']);
