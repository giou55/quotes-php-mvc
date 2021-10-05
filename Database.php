<?php

class Database {
    public $pdo;
    public static Database $db;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=quotes;charset=utf8', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }

    public function getAllQuotes() {
        $statement = $this->pdo->prepare('SELECT * FROM quotes ORDER BY create_date DESC');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuotesByPage($page_first_result, $results_per_page) {
        $statement = $this->pdo->prepare('SELECT * FROM quotes LIMIT ' . $page_first_result . ',' . $results_per_page);
        // $statement->bindValue(':page', $page_first_result);
        //$statement->bindValue(':results', $results_per_page);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchQuotes($keyword = '') {
        $statement = $this->pdo->prepare('SELECT * FROM quotes WHERE body like :keyword ORDER BY create_date DESC');
        $statement->bindValue(":keyword", "%$keyword%");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuoteById($id) {
        $statement = $this->pdo->prepare('SELECT * FROM quotes WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getQuotesByAuthorId($author_id) {
        $statement = $this->pdo->prepare('SELECT * FROM quotes WHERE author_id = :author_id');
        $statement->bindValue(':author_id', $author_id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuotesByTagId($tagId) {
        $statement = $this->pdo->prepare(
            'SELECT quotes.id, quotes.body, quotes.author_id, quotes.author_name, quotes.author_role, quotes.create_date
            FROM quotes 
            JOIN quote_tag 
            ON quotes.id = quote_tag.quote_id
            WHERE quote_tag.tag_id = :id');
        $statement->bindValue(':id', $tagId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createQuote(Quote $quote) {
        $statement = $this->pdo->prepare(
            "INSERT INTO quotes (body, author_id, author_name, author_role)
            VALUES (:body, :author_id, :author_name, :author_role)"
        );
        $statement->bindValue(':body', $quote->body);
        $statement->bindValue(':author_id', $quote->author_id);
        $statement->bindValue(':author_name', $quote->author_name);
        $statement->bindValue(':author_role', $quote->author_role);
        $statement->execute();

        if ($quote->tags !== null) {
            function add_quoteId($tagId) {
                return "(:id, " . $tagId . ")";
            }
            $valuesArray = array_map('add_quoteId', $quote->tags);
            $valuesStr = implode(" ,", $valuesArray);

            $statement = $this->pdo->prepare(
                "SELECT id FROM quotes ORDER BY id DESC LIMIT 1"
            );
            $statement->execute();
            $lastQuoteId = $statement->fetch(PDO::FETCH_ASSOC);

            $statement = $this->pdo->prepare(
                "INSERT INTO quote_tag (quote_id, tag_id) VALUES $valuesStr"
            );
            $statement->bindValue(':id', $lastQuoteId["id"]);
            $statement->execute();
        }
    }

    public function updateQuote(Quote $quote) {
        $statement = $this->pdo->prepare(
            "UPDATE quotes SET body = 
            :body, author_id = :author_id, author_name = :author_name, author_role = :author_role 
            WHERE id = :id"
        );
        $statement->bindValue(':body', $quote->body);
        $statement->bindValue(':author_id', $quote->author_id);
        $statement->bindValue(':author_name', $quote->author_name);
        $statement->bindValue(':author_role', $quote->author_role);
        $statement->bindValue(':id', $quote->id);
        $statement->execute();

        if ($quote->tags !== null) {
            function add_quoteId($tagId) {
                return "(:id, " . $tagId . ")";
            }
            $valuesArray = array_map('add_quoteId', $quote->tags);
            $valuesStr = implode(" ,", $valuesArray);

            $statement = $this->pdo->prepare(
                "DELETE FROM quote_tag WHERE quote_id = :id"
            );
            $statement->bindValue(':id', $quote->id);
            $statement->execute();

            //"INSERT INTO quote_tag (quote_id, tag_id) VALUES (:id,6),(:id,7),(:id,3),(:id,4),(:id,5)"

            $statement = $this->pdo->prepare(
                "INSERT INTO quote_tag (quote_id, tag_id) VALUES $valuesStr"
            );
            $statement->bindValue(':id', $quote->id);
            $statement->execute();
        } else {
            $statement = $this->pdo->prepare(
                "DELETE FROM quote_tag WHERE quote_id = :id"
            );
            $statement->bindValue(':id', $quote->id);
            $statement->execute();
        }  
    }

    public function updateQuoteInAuthorDetails($quote, Author $author) {
        $statement = $this->pdo->prepare(
            "UPDATE quotes SET author_id = :author_id, author_name = :author_name, author_role = :author_role 
            WHERE id = :id"
        );
        $statement->bindValue(':author_id', $author->id);
        $statement->bindValue(':author_name', $author->name);
        $statement->bindValue(':author_role', $author->role);
        $statement->bindValue(':id', $quote['id']);
        $statement->execute();
    }

    public function deleteQuote($id) {
        $statement = $this->pdo->prepare('DELETE FROM quotes WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();

        $statement = $this->pdo->prepare('DELETE FROM quote_tag WHERE quote_id = :id');
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    public function getAuthors() {
        $statement = $this->pdo->prepare('SELECT * FROM author ORDER BY name ASC');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAuthor(Author $author) {
        $statement = $this->pdo->prepare(
            "INSERT INTO author (name, keyword, role)
            VALUES (:name, :keyword, :role)"
        );
        $statement->bindValue(':name', $author->name);
        $statement->bindValue(':keyword', $author->keyword);
        $statement->bindValue(':role', $author->role);
        $statement->execute();
    }

    public function updateAuthor(Author $author) {
        $statement = $this->pdo->prepare(
            "UPDATE author SET name = :name, keyword = :keyword, role = :role 
            WHERE id = :id"
        );
        $statement->bindValue(':name', $author->name);
        $statement->bindValue(':keyword', $author->keyword);
        $statement->bindValue(':role', $author->role);
        $statement->bindValue(':id', $author->id);
        $statement->execute();
    }

    public function deleteAuthor($id) {
        $statement = $this->pdo->prepare('DELETE FROM author WHERE id = :id');
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

    public function getTags() {
        $statement = $this->pdo->prepare('SELECT * FROM tags ORDER BY title ASC');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTagsForOneQuote($quoteId) {
        $statement = $this->pdo->prepare('SELECT tags.title, tags.id 
                                          FROM tags 
                                          JOIN quote_tag 
                                          ON tags.id = quote_tag.tag_id
                                          WHERE quote_tag.quote_id = :id');
        $statement->bindValue(':id', $quoteId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createTag(Tag $tag) {
        $statement = $this->pdo->prepare(
            "INSERT INTO tags (title)
            VALUES (:title)"
        );
        $statement->bindValue(':title', $tag->title);
        $statement->execute();
    }

    public function updateTag(Tag $tag) {
        $statement = $this->pdo->prepare(
            "UPDATE tags SET title = :title WHERE id = :id"
        );
        $statement->bindValue(':title', $tag->title);
        $statement->bindValue(':id', $tag->id);
        $statement->execute();
    }

    public function deleteTag($id) {
        $statement = $this->pdo->prepare('DELETE FROM tags WHERE id = :id');
        $statement->bindValue(':id', $id);
        return $statement->execute();
    }

}