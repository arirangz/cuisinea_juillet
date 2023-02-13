<?php


require_once 'lib/config.php';
require_once 'lib/pdo.php';
require_once 'lib/recipe.php';
require_once 'templates/header.php';

$error = false;

if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    $recipe = getRecipeById($pdo, $id);

    // Si une recette a été récupéré
    if ($recipe) {
    } else {
        $error = true;
    }
} else {
    $error = true;
}


if (!$error) {
    ?>

            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="<?=getRecipeImage($recipe['image']) ?>" class="d-block mx-lg-auto img-fluid" alt="<?=$recipe['title'] ?>" width="400" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3"><?=$recipe['title'] ?></h1>
                    <p class="lead"><?=$recipe['description'] ?></p>
                </div>
            </div>

<?php } else { ?>
    <h1>La recette n'existe pas</h1>
<?php } ?>

            
<?php  require_once 'templates/footer.php'; ?>