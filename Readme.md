# SETUP 
```
PHP 8.1.10 (cli)
MySQL 8.0.33
```

# Dessign Pattern


 Modèle MVC (Modèle-Vue-Contrôleur) : Ce design pattern est utilisé pour organiser l'architecture de l'application en séparant les responsabilités en trois composants principaux :

   - Contrôleurs (CategoryController et ArticleController) : Ces classes sont responsables de la gestion des actions utilisateur et de la communication avec les modèles et les vues. Par exemple, dans le code suivant, le contrôleur ArticleController est utilisé pour lire un article spécifique en fonction de l'ID :

     ```php
     $articleController = new ArticleController();
     $article = $articleController->readone($id);
     ```

   - Modèles (Category et Article) : Ces classes représentent les entités du domaine et contiennent la logique métier. Par exemple, la méthode `getArticlesByCategory` de la classe Category est utilisée pour obtenir les articles d'une catégorie spécifique :

     ```php
     $articles = $category->getArticlesById($id);
     ```

   - Vues (fichiers HTML) : Les fichiers HTML sont utilisés pour afficher les données aux utilisateurs. Par exemple, dans le code suivant, la vue affiche le titre et la catégorie d'un article :

     ```html
     <h2 class="post-title"><?php echo $article->getTitle(); ?></h2>
     <h3 class="post-subtitle"><?php echo $article->getCategory(); ?></h3>
     ```
