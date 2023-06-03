<?php

require_once '../Model/Category.php';

class CategoryController {
  public function getAll() {
    
    return Category::getAll();
  }

  public function getArticlesByCategory($id) {
    $articles = new Category();
    return $articles->getArticlesById($id);
  }
}

?>
