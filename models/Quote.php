<?php 

namespace app\models;

use app\Database;

class Quote {
    public ?int $id = null; 
    public ?string $body = null; 
    public ?string $author_id = null; 
    public ?string $author_name = null; 

    public function load($data) {
        $this->id = $data['id'] ?? null;
        $this->body = $data['body'];
        $this->author_id = $data['author_id'] ?? null;
        $this->author_name = $data['author_name'] ?? null;
    }

    public function save() {
        $errors = [];

        if (!$this->body) {
            $errors[] = 'Quote body is required';
        }

        if (!$this->author_id) {
            $errors[] = 'Quote author is required';
        }

        if (empty($errors)) {
            $db = Database::$db;
            if ($this->id) {
                $db->updateQuote($this);
            } else {
                $db->createQuote($this);
            }
        }

        return $errors;
    }
}