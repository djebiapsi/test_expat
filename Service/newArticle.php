<?php
    require_once '../Controller/ArticleController.php';
    require_once '../Controller/CategoryController.php';

    foreach ($_POST as $key => $post) {
        $$key = $post;
    }

    $articleController = new ArticleController();
    $articleController->create($title, $content, $category);