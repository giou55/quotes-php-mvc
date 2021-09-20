<?php

namespace app\controllers;

use app\Router;

class AuthorController {
    public static function index(Router $router) {
        $search = $_GET['search'] ?? '';
        // $authors = $router->db->getAuthors($search);
        $authors = $router->db->getAuthors();
        $router->renderView('authors/index', [
            'authors' => $authors,
            'search' => $search
        ]);
    }
}