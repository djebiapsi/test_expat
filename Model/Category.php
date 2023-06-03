<?php

require_once '../config/database.php';

class Category {
  private $id;
  private $name;
  private $description;

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getDescription() {
    return $this->description;
  }

 public static function getAll() {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT * FROM category");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $categories = [];

    foreach ($result as $row) {
        $category = new Category();
        $category->id = $row['id'];
        $category->name = $row['name'];
        $category->description = $row['description'];

        $categories[] = $category;
    }

    return $categories;
}

public function getArticles() {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT a.* FROM article a JOIN article_has_category ac ON a.id = ac.article_id WHERE ac.category_id = :category_id");
    $stmt->bindParam(':category_id', $this->id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $articles = [];

    foreach ($result as $row) {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);

        $articles[] = $article;
    }

    return $articles;
}

public function getArticlesById($id) {
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT a.* FROM article a JOIN article_has_category ac ON a.id = ac.article_id WHERE ac.category_id = :category_id");
    $stmt->bindParam(':category_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $articles = [];

    foreach ($result as $row) {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);

        $articles[] = $article;
    }

    return $articles;
}

}

?>
