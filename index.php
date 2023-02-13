<?php


require_once 'lib/config.php';
require_once 'lib/pdo.php';
require_once 'lib/recipe.php';
require_once 'templates/header.php';

$recipes = getRecipes($pdo, 3);
?>

<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="assets/images/logo-cuisinea.jpg" class="d-block mx-lg-auto img-fluid" alt="Cuisinea" width="400" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3">Recettes de cuisines pour tout le monde</h1>
        <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Voir toutes nos recettes</button>
        </div>
    </div>
</div>

<div class="row text-center">
    <?php foreach ($recipes as $index => $recipe) {
        require 'templates/recipe_part.php';
    }
    ?>

</div>


<?php require_once 'templates/footer.php'; ?>