<?php

require_once '../config/Database.php';

class Article {
  private $id;
  private $title;
  private $content;
  private $category;

  public function getId() {
    return $this->id;
  }
  public function setId($id) {
    $this->id = $id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function getContent() {
    return $this->content;
  }

  public function setContent($content) {
    $this->content = $content;
  }

  public function getCategory() {
    return $this->category;
  }

  public function setCategory($category) {
    $this->category = $category;
  }

  public function save() {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Insertion de l'article dans la table `article`
    $stmt = $conn->prepare("INSERT INTO article (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $this->title, $this->content);
    $stmt->execute();

    // Récupération de l'ID généré pour l'article
    $this->id = $stmt->insert_id;

    // Liaison de l'article avec la catégorie si spécifiée
    if (!empty($this->category_id)) {
      $stmt = $conn->prepare("INSERT INTO article_has_category (article_id, category_id) VALUES (?, ?)");
      $stmt->bind_param("ii", $this->id, $this->category_id);
      $stmt->execute();
    }

    $stmt->close();
  }
}

?>
