<?php

namespace app\controllers;

use app\Router;
use app\models\Quote;

class QuoteController {
    public static function index(Router $router) {
        $search = $_GET['search'] ?? '';
        $quotes = $router->db->getQuotes($search);
        $authors = $router->db->getAuthors();
        $router->renderView('quotes/index', [
            'quotes' => $quotes,
            'authors' => $authors,
            'search' => $search
        ]);
    }

    public static function create(Router $router) {
        $errors = [];
        $quoteData = [
            'body' => '',
            'author_id' => '',
            'author_name' => '',
            'author_role' => ''
        ];

        $authorData = explode('&', $_POST['author']);
        $author_id = $authorData[0];
        $author_name = $authorData[1];
        $author_role = $authorData[2];

        $quoteData['author_id'] = $author_id;
        $quoteData['author_name'] = $author_name;
        $quoteData['author_role'] = $author_role;
        $quoteData['body'] = $_POST['body'];

        $quote = new Quote();
        $quote->load($quoteData);
        $errors = $quote->save();
        if (empty($errors)) {
            header('Location: /quotes');
            exit;
        }
    }

   public static function update(Router $router) {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /quotes');
            exit;
        }

        $quoteData = [
            'id' => '',
            'body' => '',
            'author_id' => '',
            'author_name' => '',
            'author_role' => ''
        ];

        $authorData = explode('&',$_POST['author']);
        $author_id = $authorData[0];
        $author_name = $authorData[1];
        $author_role = $authorData[2];

        $quoteData['id'] = $id;
        $quoteData['author_id'] = $author_id;
        $quoteData['author_name'] = $author_name;
        $quoteData['author_role'] = $author_role;
        $quoteData['body'] = $_POST['body'];

        $quote = new Quote();
        $quote->load($quoteData);
        $quote->save();
        header('Location: /quotes');
        exit;
    }

    public static function delete(Router $router) {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /quotes');
            exit;
        }
        if ($router->db->deleteQuote($id)) {
            header('Location: /quotes');
            exit;
        }
    }
}