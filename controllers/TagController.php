<?php

namespace app\controllers;

use app\Router;
use app\models\Tag;

class TagController {
    public static function index(Router $router) {
        $errors = [];
        $tagData = [
            'id' => '',
            'title' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $tagData['id'] = $_POST['id'] ?? null;
            $tagData['title'] = $_POST['title'];

            $tag = new Tag();
            $tag->load($tagData);
            $errors = $tag->save();
            if (empty($errors)) {
                header('Location: /tags');
                exit;
            }
        }

        $search = $_GET['search'] ?? '';
        // $authors = $router->db->getAuthors($search);
        $tags = $router->db->getTags();
        $router->renderView('tags/index', [
            'tags' => $tags,
            'search' => $search
        ]);
    }

    public static function delete(Router $router) {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /tags');
            exit;
        }
        if ($router->db->deleteTag($id)) {
            header('Location: /tags');
            exit;
        }
    }
}