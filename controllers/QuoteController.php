<?php

namespace app\controllers;

use app\Router;
use app\models\Quote;

class QuoteController {
    public static function index(Router $router) {
        $search = $_GET['search'] ?? '';
        $quotes = $router->db->getQuotes($search);
        $router->renderView('products/index', [
            'quotes' => $quotes,
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
        $router->renderView('products/create', [
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
        $productData = $router->db->getProductById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData['title'] = $_POST['title'];
            $productData['description'] = $_POST['description'];

            $product = new Quote();
            $product->load($productData);
            $product->save();
            header('Location: /quotes');
            exit;
        }
        $router->renderView('quotes/update', [
            'product' => $productData
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