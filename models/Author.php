<?php 

require_once "./../Database.php";

class Author {
    public ?int $id = null; 
    public ?string $name = null; 
    public ?string $keyword = null; 
    public ?string $role = null; 


    public function load($data) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->keyword = $data['keyword'];
        $this->role = $data['role'];
    }

    public function save() {
        $errors = [];

        if (!$this->name) {
            $errors[] = 'Author name is required';
        }

        if (!$this->keyword) {
            $errors[] = 'Author keyword is required';
        }
        if (!$this->role) {
            $errors[] = 'Author role is required';
        }

        if (empty($errors)) {
            $db = Database::$db;
            if ($this->id) {
                $db->updateAuthor($this);
                $quotes = $db->getQuotesByAuthorId($this->id);
                foreach ($quotes as $quote) {
                    $db->updateQuoteInAuthorDetails($quote, $this);
                }
            } else {
                $db->createAuthor($this);
            }
        }

        return $errors;
    }
}