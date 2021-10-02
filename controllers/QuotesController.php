<?php

require_once "../Router.php";
require_once "../models/Quote.php";

class QuotesController {
    public static function index(Router $router) {
        $quotes = $router->db->getQuotes();
        $tags = $router->db->getTags();

        foreach($quotes as &$value) {
            $tags_of_quote = $router->db->getTagsForOneQuote($value['id']);
            $value['tags'] = $tags_of_quote;
        }

        $authors = $router->db->getAuthors();
        $router->renderView('quotes/index', [
            'quotes' => $quotes,
            'authors' => $authors,
            'tags' => $tags
        ]);
    }

    public static function search(Router $router) {
        $search = $_POST['search'] ?? '';
        $quotes = $router->db->getQuotes($search);
        $authors = $router->db->getAuthors();
        $router->renderView('quotes/search', [
            'quotes' => $quotes,
            'authors' => $authors,
            'search' => $search
        ]);
    }

    public static function create(Router $router) {
        $quoteData = [
            'body' => '',
            'author_id' => '',
            'author_name' => '',
            'author_role' => '',
            'tags' => []
        ];

        $authorData = explode('&', $_POST['author']);
        $author_id = $authorData[0] ?? null;
        $author_name = $authorData[1] ?? null;
        $author_role = $authorData[2] ?? null;

        $quoteData['author_id'] = $author_id;
        $quoteData['author_name'] = $author_name;
        $quoteData['author_role'] = $author_role;
        $quoteData['body'] = $_POST['body'];
        $quoteData['tags'] = $_POST['tags'];

        $quote = new Quote();
        $quote->load($quoteData);
        $quote->save();
        header('Location: /quotes');
        exit;
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
            'author_role' => '',
            'tags' => []
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
        $quoteData['tags'] = $_POST['tags'];

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