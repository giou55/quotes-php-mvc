<?php 

require_once "../Database.php";

class Quote {
    public ?int $id = null; 
    public ?string $body = null; 
    public ?string $author_id = null; 
    public ?string $author_name = null; 
    public ?string $author_role = null; 
    public ?array $tags = []; 

    public function load($data) {
        $this->id = $data['id'] ?? null;
        $this->body = $data['body'];
        $this->author_id = $data['author_id'] ?? null;
        $this->author_name = $data['author_name'] ?? null;
        $this->author_role = $data['author_role'] ?? null;
        $this->tags = $data['tags'] ?? null;
    }

    public function save() {
        $errors = [];

        if (!$this->body) {
            $errors[] = 'Quote body is required';
        }
        if (!$this->author_name) {
            $errors[] = 'Quote author is required';
        }
        if (empty($errors)) {
            $db = Database::$db;
            if ($this->id) {
                $db->updateQuote($this);
            } else {
                $db->createQuote($this);
            }
        } else {
            return $errors;
        }
    }
}