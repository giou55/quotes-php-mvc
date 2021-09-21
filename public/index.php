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
$router->post('/authors', [AuthorController::class, 'index']);
$router->get('/authors/create', [AuthorController::class, 'create']);
$router->post('/authors/create', [AuthorController::class, 'create']);
$router->get('/authors/update', [AuthorController::class, 'update']);
$router->post('/authors/update', [AuthorController::class, 'update']);
$router->post('/authors/delete', [AuthorController::class, 'delete']);

$router->get('/tags', [TagController::class, 'index']);
$router->post('/tags', [TagController::class, 'index']);
$router->get('/tags/create', [TagController::class, 'create']);
$router->post('/tags/create', [TagController::class, 'create']);
$router->get('/tags/update', [TagController::class, 'update']);
$router->post('/tags/update', [TagController::class, 'update']);
$router->post('/tags/delete', [TagController::class, 'delete']);


$router->resolve();
