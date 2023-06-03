<?php
    require_once '../Controller/CategoryController.php';
    require_once '../Controller/ArticleController.php';

    if (isset($_GET["categoryId"])) {
        $categoryId = $_GET["categoryId"];
        $categoryController = new CategoryController();
        $articles = $categoryController->getArticlesByCategory($categoryId);
    }else {
        $categoryId = 0;
        $articleC = new ArticleController;
        $articles = $articleC->readAll();
    }
    // Appel au contrôleur Category pour récupérer les catégories
    $categoryController = new CategoryController();
    $categories = $categoryController->getAll();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Accueil</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php">expat</a>
            <button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="newArticle.php">Nouvel article</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="background-image:url('assets/img/home-bg.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="site-heading">
                        <h1>Blog</h1>
                        <span class="subheading"></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <label class="form-label">Category</label>
        <select class="form-control" id="categorySelect" onChange="reload_category(document.getElementById('categorySelect').value)">
            <option value=0>Toutes</option>
            <?php foreach ($categories as $category) {
                    if ($categoryId == $category->getId()) {
                        ?>
                <option selected value=<?php echo $category->getId(); ?>><?php echo $category->getName(); ?></option>
            <?php }else { ?>
                <option value=<?php echo $category->getId(); ?>><?php echo $category->getName(); ?></option>
            <?php } }?>
        </select>
        <hr>
        <div class="row" id="articlesContainer">
            <?php foreach ($articles as $article) { ?>
                <div class="col-md-10 col-lg-8">
                    <div class="post-preview">
                        <a href="article.php?id=<?= $article->getId()?>">
                            <h2 class="post-title"><?php echo $article->getTitle(); ?></h2>
                            <h3 class="post-subtitle"><?php echo $article->getCategory(); ?></h3>
                        </a>
                    </div>
                    <hr>
                </div>
            <?php } ?>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto"></div>
            </div>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/clean-blog.js"></script>
    <script>
        function reload_category(id){
            if (id != 0) {
                document.location.href="index.php?categoryId=" + id; 
            } else {
                document.location.href="index.php";
            }
        }
    </script>
</body>

</html>
