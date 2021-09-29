<?php

require_once "../Router.php";
require_once "../models/Tag.php";

class TagsController {
    public static function index(Router $router) {
        $tags = $router->db->getTags();
        $router->renderView('tags/index', [
            'tags' => $tags,
            'search' => ''
        ]);
    }

    public static function create(Router $router) {
        $errors = [];
        $tagData = [
            'title' => ''
        ];
        $tagData['title'] = $_POST['title'];

        $tag = new Tag();
        $tag->load($tagData);
        $errors = $tag->save();
        if (empty($errors)) {
            header('Location: /tags');
            exit;
        }
    }

    public static function update(Router $router) {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /tags');
            exit;
        }
        $tagData = [
            'id' => '',
            'title' => ''
        ];
        $tagData['id'] = $id;
        $tagData['title'] = $_POST['title'];

        $tag = new Tag();
        $tag->load($tagData);
        $errors = $tag->save();
        if (empty($errors)) {
            header('Location: /tags');
            exit;
        }
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