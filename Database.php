<?php

namespace app;

use PDO;
use app\models\Quote;

class Database {
    public \PDO $pdo;
    public static Database $db;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=quotes', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }

    public function getQuotes($keyword = '') {
        if ($keyword) {
            $statement = $this->pdo->prepare('SELECT * FROM quotes WHERE body like :keyword ORDER BY create_date DESC');
            $statement->bindValue(":keyword", "%$keyword%");
        } else {
            $statement = $this->pdo->prepare('SELECT * FROM quotes ORDER BY create_date DESC');
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuoteById($id) {
        $statement = $this->pdo->prepare('SELECT * FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createQuote(Quote $quote) {
        $statement = $this->pdo->prepare(
            "INSERT INTO quotes (title, image, description, price, create_date)
            VALUES (:title, :image, :description, :price, :date)"
        );
        $statement->bindValue(':title', $quote->title);
        $statement->bindValue(':description', $quote->description);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
        $statement->execute();
    }

    public function updateQuote(Quote $quote) {
        $statement = $this->pdo->prepare(
            "UPDATE products SET title = :title, 
            image = :image, description = :description, price = :price WHERE id = :id"
        );
        $statement->bindValue(':title', $quote->title);
        $statement->bindValue(':description', $quote->description);
        $statement->bindValue(':id', $quote->id);
        $statement->execute();
    }

    public function deleteQuote($id) {
        $statement = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    public function getAuthors() {
        $statement = $this->pdo->prepare('SELECT * FROM author ORDER BY name DESC');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTags() {
        $statement = $this->pdo->prepare('SELECT * FROM tags ORDER BY title DESC');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}