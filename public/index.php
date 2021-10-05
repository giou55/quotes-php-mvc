<?php

require_once "../controllers/AuthorsController.php";
require_once "../controllers/QuotesController.php";
require_once "../controllers/TagsController.php";
require_once "../Router.php";

$router = new Router();

$router->get('/', [QuotesController::class, 'index']);
$router->get('/quotes', [QuotesController::class, 'index']);
$router->post('/quotes', [QuotesController::class, 'index']);
$router->post('/quotes/search', [QuotesController::class, 'search']);
$router->get('/quotes/create', [QuotesController::class, 'create']);
$router->post('/quotes/create', [QuotesController::class, 'create']);
$router->get('/quotes/update', [QuotesController::class, 'update']);
$router->post('/quotes/update', [QuotesController::class, 'update']);
$router->post('/quotes/delete', [QuotesController::class, 'delete']);

$router->get('/authors', [AuthorsController::class, 'index']);
$router->post('/authors', [AuthorsController::class, 'index']);
$router->get('/authors/create', [AuthorsController::class, 'create']);
$router->post('/authors/create', [AuthorsController::class, 'create']);
$router->get('/authors/update', [AuthorsController::class, 'update']);
$router->post('/authors/update', [AuthorsController::class, 'update']);
$router->post('/authors/delete', [AuthorsController::class, 'delete']);

$router->get('/tags', [TagsController::class, 'index']);
$router->post('/tags', [TagsController::class, 'index']);
$router->get('/tags/create', [TagsController::class, 'create']);
$router->post('/tags/create', [TagsController::class, 'create']);
$router->get('/tags/update', [TagsController::class, 'update']);
$router->post('/tags/update', [TagsController::class, 'update']);
$router->post('/tags/delete', [TagsController::class, 'delete']);

$router->resolve();
