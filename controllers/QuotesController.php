<?php

require_once "../Router.php";
require_once "../models/Quote.php";

class QuotesController {
    public static function index(Router $router) {
        $results_per_page = 20; 

        if (isset ($_POST['page']) ) {  
            $page = $_POST['page'];   
            $page_first_result = ($page-1) * $results_per_page;  

            $quotes = $router->db->getAllQuotes();
            $number_of_result = count($quotes);  
            $number_of_page = ceil($number_of_result / $results_per_page); 
            $quotes = $router->db->getQuotesByPage($page_first_result, $results_per_page);
            $tags = $router->db->getTags();

            foreach($quotes as &$value) {
                $tags_of_quote = $router->db->getTagsForOneQuote($value['id']);
                $value['tags'] = $tags_of_quote;
            }

            $authors = $router->db->getAuthors();
            $router->renderView('quotes/index', [
                'quotes' => $quotes,
                'authors' => $authors,
                'tags' => $tags,
                'page' => $number_of_page,
                'current_page' => $page
            ]);
        } else {
            $page = 1;  
            $page_first_result = ($page-1) * $results_per_page;  

            $quotes = $router->db->getAllQuotes();
            $number_of_result = count($quotes);  
            $number_of_page = ceil($number_of_result / $results_per_page); 
            $quotes = $router->db->getQuotesByPage($page_first_result, $results_per_page);
            $tags = $router->db->getTags();

            foreach($quotes as &$value) {
                $tags_of_quote = $router->db->getTagsForOneQuote($value['id']);
                $value['tags'] = $tags_of_quote;
            }

            $authors = $router->db->getAuthors();
            $router->renderView('quotes/index', [
                'quotes' => $quotes,
                'authors' => $authors,
                'tags' => $tags,
                'page' => $number_of_page,
                'current_page' => $page
            ]);
        }  
    }

    public static function search(Router $router) {
        if (isset($_POST['search'])) {
           $search = $_POST['search'] ?? '';
            $quotes = $router->db->searchQuotes($search);

            $tags = $router->db->getTags();
            foreach($quotes as &$value) {
                $tags_of_quote = $router->db->getTagsForOneQuote($value['id']);
                $value['tags'] = $tags_of_quote;
            }
            
            $authors = $router->db->getAuthors();
            $router->renderView('quotes/search', [
                'quotes' => $quotes,
                'authors' => $authors,
                'tags' => $tags,
                'search' => $search
            ]); 
        }
        if (isset($_POST['author'])) {
            $author = $_POST['author'] ?? '';
            if ($author === "all") {
                $quotes = $router->db->getAllQuotes();
            } else {
                $authorData = explode('&', $_POST['author']);
                $author_id = $authorData[0] ?? null;
                $author_name = $authorData[1] ?? null;
                $quotes = $router->db->getQuotesByAuthorId($author_id);
            }

            $tags = $router->db->getTags();
            foreach($quotes as &$value) {
                $tags_of_quote = $router->db->getTagsForOneQuote($value['id']);
                $value['tags'] = $tags_of_quote;
            }

            $authors = $router->db->getAuthors();
            $router->renderView('quotes/index', [
                'quotes' => $quotes,
                'authors' => $authors,
                'tags' => $tags,
                'author_id' => $author_id ?? null,
                'author_name' => $author_name ?? null

            ]); 
        }

        if (isset($_POST['tag'])) {
            $tag = $_POST['tag'] ?? '';
            if ($tag === "all") {
                $quotes = $router->db->getAllQuotes();
            } else {
                $tagData = explode('&', $_POST['tag']);
                $tag_id = $tagData[0] ?? null;
                $tag_title = $tagData[1] ?? null;
                $quotes = $router->db->getQuotesByTagId($tag_id);
            }

            $tags = $router->db->getTags();
            foreach($quotes as &$value) {
                $tags_of_quote = $router->db->getTagsForOneQuote($value['id']);
                $value['tags'] = $tags_of_quote;
            }

            $authors = $router->db->getAuthors();
            $router->renderView('quotes/index', [
                'quotes' => $quotes,
                'authors' => $authors,
                'tags' => $tags,
                'tag_id' => $tag_id ?? null,
                'tag_title' => $tag_title ?? null,
                'author_id' => $author_id ?? null,
                'author_name' => $author_name ?? null

            ]); 
        }
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