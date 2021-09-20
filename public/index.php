<?php

use app\Router;
use app\controllers\QuoteController;
use app\controllers\AuthorController;
use app\controllers\TagController;

require_once __DIR__.'/../vendor/autoload.php';

$router = new Router();

$router->get('/', [QuoteController::class, 'index']);
$router->get('/quotes', [QuoteController::class, 'index']);
$router->get('/quotes/create', [QuoteController::class, 'create']);
$router->post('/quotes/create', [QuoteController::class, 'create']);
$router->get('/quotes/update', [QuoteController::class, 'update']);
$router->post('/quotes/update', [QuoteController::class, 'update']);
$router->post('/quotes/delete', [QuoteController::class, 'delete']);

$router->get('/authors', [AuthorController::class, 'index']);

$router->get('/tags', [TagController::class, 'index']);


$router->resolve();
