<?php

require_once "../controllers/AuthorsController.php";
require_once "../controllers/QuotesController.php";
require_once "../controllers/TagsController.php";
require_once "Database.php";

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
       $currentUrl = $_SERVER['REQUEST_URI'] ?? '/'; 
       $method = $_SERVER['REQUEST_METHOD'];

       if ($method === 'GET') {
           $controllerName = $this->getRoutes[$currentUrl][0] ?? null;
           $fn = $this->getRoutes[$currentUrl][1] ?? null;
       } else {
           $controllerName = $this->postRoutes[$currentUrl][0] ?? null;
           $fn = $this->postRoutes[$currentUrl][1] ?? null;
       } 

       if ($fn) {
            $qc = new $controllerName();
            call_user_func(array($qc, $fn), $this);
       } elseif ($currentUrl === '/') {
            $qc = new QuotesController();
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
