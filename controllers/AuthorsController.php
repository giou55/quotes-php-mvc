<?php

require_once "../Router.php";
require_once "../models/Author.php";

class AuthorsController {
    public static function index(Router $router) {
        $authors = $router->db->getAuthors();
        $router->renderView('authors/index', [
            'authors' => $authors,
            'search' => ''
        ]);
    }

    public static function create(Router $router) {
        $errors = [];
        $authorData = [
            'name' => '',
            'keyword' => '',
            'role' => ''
        ];
        $authorData['name'] = $_POST['name'];
        $authorData['keyword'] = $_POST['keyword'];
        $authorData['role'] = $_POST['role'];

        $author = new Author();
        $author->load($authorData);
        $errors = $author->save();
        if (empty($errors)) {
            header('Location: /authors');
            exit;
        }
    }

    public static function update(Router $router) {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /authors');
            exit;
        }
        $authorData = [
            'id' => '',
            'name' => '',
            'keyword' => '',
            'role' => ''
        ];
        $authorData['id'] = $id;
        $authorData['name'] = $_POST['name'];
        $authorData['keyword'] = $_POST['keyword'];
        $authorData['role'] = $_POST['role'];

        $author = new Author();
        $author->load($authorData);
        $errors = $author->save();
        if (empty($errors)) {
            header('Location: /authors');
            exit;
        }
    }

    public static function delete(Router $router) {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /authors');
            exit;
        }
        if ($router->db->deleteAuthor($id)) {
            header('Location: /authors');
            exit;
        }
    }
}