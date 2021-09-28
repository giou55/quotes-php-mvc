<?php

require_once "./../controllers/AuthorController.php";
require_once "./../controllers/QuoteController.php";
require_once "./../controllers/TagController.php";
// require_once "./Database.php";

class Router {
    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function get($url, $fn) {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve() {
       $currentUrl = $_SERVER['PATH_INFO'] ?? '/'; 
       $method = $_SERVER['REQUEST_METHOD'];

       if ($method === 'GET') {
           $fn = $this->getRoutes[$currentUrl][1] ?? null;
       } else {
           $fn = $this->postRoutes[$currentUrl][1] ?? null;
       } 
       if ($fn && strpos($currentUrl, 'quotes')) {
            $qc = new QuoteController();
            call_user_func(array($qc, $fn), $this);
       } elseif ($fn && strpos($currentUrl, 'authors')) {
           $qc = new AuthorController();
            call_user_func(array($qc, $fn), $this);
       } elseif ($fn && strpos($currentUrl, 'tags')) {
           $qc = new TagController();
            call_user_func(array($qc, $fn), $this);
       } elseif ($currentUrl === '/') {
           $qc = new QuoteController();
           call_user_func(array($qc, 'index'), $this);
       } else {
           echo "Page not found";
       }
    }

    public function renderView($view, $params = []) {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once __DIR__."/views/$view.php";
        $content = ob_get_clean();
        include_once __DIR__."/views/layout.php";
    }
}
