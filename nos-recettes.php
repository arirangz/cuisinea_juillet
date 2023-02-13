<?php
require_once 'lib/config.php';
require_once 'lib/pdo.php';
require_once 'lib/recipe.php';
require_once 'templates/header.php';

$recipes = getRecipes($pdo);

?>

            <div class="row">
                <h1>Nos recettes</h1>
            </div>
            <div class="row text-center">
                <?php foreach ($recipes as $index => $recipe) {
                    require 'templates/recipe_part.php' ;
                } 
                ?>

            </div>

            
<?php  require_once 'templates/footer.php'; ?>