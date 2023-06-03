<?php
/**
 * Logique Article
*/
require_once '../Model/Article.php';
require_once '../config/database.php';

class ArticleController {
    

   

    // Créer un nouvel article
    public function create($title, $content, $category_id) {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "INSERT INTO article (title, content) VALUES (:title, :content)";
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
    
        if ($stmt->execute()) {
            $article_id = $conn->lastInsertId();
    
            if ($category_id != null) {
                $query = "INSERT INTO article_has_category (article_id, category_id) VALUES (:article_id, :category_id)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":article_id", $article_id);
                $stmt->bindParam(":category_id", $category_id);
                $stmt->execute();
            }
    
            return true;
        }
    
        return false;
    }
    

    // Lire tous les articles
    public function readAll() {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT article.*, category.name AS category_name
                FROM article
                LEFT JOIN article_has_category ON article.id = article_has_category.article_id
                LEFT JOIN category ON category.id = article_has_category.category_id";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $articles = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $article = new Article();
            $article->setId($row['id']);
            $article->setTitle($row['title']);
            $article->setContent($row['content']);
            $article->setCategory($row['category_name']);

            $articles[] = $article;
        }

        return $articles;
    }

    // Lire un article par son ID
    public function readOne($id) {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT article.*, category.name AS category_name
                FROM article
                LEFT JOIN article_has_category ON article.id = article_has_category.article_id
                LEFT JOIN category ON category.id = article_has_category.category_id
                WHERE article.id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setCategory($row['category_name']);

        return $article;
    }



    // Mettre à jour un article
    public function update($id, $title, $content) {
        $query = "UPDATE article SET title = :title, content = :content WHERE id = :id";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Supprimer un article
    public function delete($id) {
        $query = "DELETE FROM article WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
