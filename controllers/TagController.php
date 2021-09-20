<?php

namespace app\controllers;

use app\Router;

class TagController {
    public static function index(Router $router) {
        $search = $_GET['search'] ?? '';
        // $authors = $router->db->getAuthors($search);
        $tags = $router->db->getTags();
        $router->renderView('tags/index', [
            'tags' => $tags,
            'search' => $search
        ]);
    }
}