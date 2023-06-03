<?php
    require_once '../Controller/CategoryController.php';
    require_once '../Controller/ArticleController.php';

    // Appel au contrôleur Category pour récupérer les catégories
    $categoryController = new CategoryController();
    $categories = $categoryController->getAll();

    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Vouvel Article</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand" href="index.php">expat</a><button data-bs-toggle="collapse" data-bs-target="#navbarResponsive" class="navbar-toggler" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="newArticle.php">Nouvel article</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="background-image:url('assets/img/about-bg.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto position-relative">
                    <div class="site-heading">
                        <h1>Nouvel Article</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto">
                <form>
                    <label  class="form-label">Nom de l'article</label><input id="title" required class="form-control" type="text" name="title">
                    <label class="form-label">Contenu</label><textarea required id="content" class="form-control" name="contain"></textarea><label class="form-label">Catégorie</label>
                    <select id="category"class="form-select">
                        <option value=0>Aucune</option>
                        <?php foreach ($categories as $category) { ?>
                            <option value=<?php echo $category->getId(); ?>><?php echo $category->getName(); ?></option>
                        <?php } ?>
                    </select>
                    <hr><button id="publish" class="btn btn-primary" type="button">Publier</button>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto"></div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/clean-blog.js"></script>
    <script src="../public/js/app.js"></script>
</body>

</html>