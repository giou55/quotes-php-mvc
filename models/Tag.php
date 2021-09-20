<?php 

namespace app\models;

use app\Database;

class Tag {
    public ?int $id = null; 
    public ?string $title = null; 

    public function load($data) {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'];
    }

    public function save() {
        $errors = [];

        if (!$this->title) {
            $errors[] = 'Tag title is required';
        }

        if (empty($errors)) {
            $db = Database::$db;
            if ($this->id) {
                $db->updateTag($this);
            } else {
                $db->createTag($this);
            }
        }

        return $errors;
    }
}