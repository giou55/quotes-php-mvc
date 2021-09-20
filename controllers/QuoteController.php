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
        ];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $quoteData['body'] = $_POST['body'];

            $quote = new Quote();
            $quote->load($quoteData);
            $errors = $quote->save();
            if (empty($errors)) {
                header('Location: /quotes');
                exit;
            }
        }
        $router->renderView('quotes/create', [
            'quote' => $quoteData,
            'errors' => $errors
        ]);
    }

   public static function update(Router $router) {
        // $id = $_GET['id'] ?? null;
        // if (!$id) {
        //     header('Location: /quotes');
        //     exit;
        // }
        // $quoteData = $router->db->getQuoteById($id);

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quoteData['body'] = $_POST['body'];
            // $quoteData['author_id'] = $_POST['author_id'];

            $quote = new Quote();
            $quote->load($quoteData);
            $quote->save();
            header('Location: /quotes');
            exit;
        // }
        // $router->renderView('quotes', [
        //     'quote' => $quoteData
        // ]);
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