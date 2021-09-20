<?php

namespace app;

use app\controllers\QuoteController;
use app\controllers\AuthorController;
use app\controllers\TagController;
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

        // echo '<pre>';
        // var_dump($currentUrl);
        // echo '</pre>';
        // exit;

       if ($fn && $currentUrl === '/quotes') {
            $qc = new QuoteController();
            call_user_func(array($qc, $fn), $this);
       } elseif ($fn && $currentUrl === '/authors') {
           $qc = new AuthorController();
            call_user_func(array($qc, $fn), $this);
       } elseif ($fn && $currentUrl === '/tags') {
           $qc = new TagController();
            call_user_func(array($qc, $fn), $this);
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
