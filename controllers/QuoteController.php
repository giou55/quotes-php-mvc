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
            'title' => '',
            'description' => '',
        ];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $quoteData['title'] = $_POST['title'];
            $quoteData['description'] = $_POST['description'];

            $quote = new Quote();
            $quote->load($quoteData);
            $errors = $quote->save();
            if (empty($errors)) {
                header('Location: /quotes');
                exit;
            }
        }
        $router->renderView('quotes/create', [
            'product' => $quoteData,
            'errors' => $errors
        ]);
    }

   public static function update(Router $router) {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /quotes');
            exit;
        }
        $quoteData = $router->db->getQuoteById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quoteData['title'] = $_POST['title'];
            $quoteData['description'] = $_POST['description'];

            $quote = new Quote();
            $quote->load($quoteData);
            $quote->save();
            header('Location: /quotes');
            exit;
        }
        $router->renderView('quotes/update', [
            'quote' => $quoteData
        ]);
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