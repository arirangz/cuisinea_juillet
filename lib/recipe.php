<?php

/*
    Ajout d'une nouvelle recette dans la bdd
*/

function saveRecipe(PDO $pdo, string $title, string $description, string $ingredients, string $instructions, int $category_id, string $image = null) {
    $query = $pdo->prepare("INSERT INTO recipes (title, description, ingredients, instructions, category_id, image) "
                    ."VALUES(:title, :description, :ingredients, :instructions, :category_id, :image)");
    
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
    $query->bindParam(':instructions', $instructions, PDO::PARAM_STR);
    $query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $query->bindParam(':image', $image, PDO::PARAM_STR);

    return $query->execute();

}

/*
    Récupération d'une recette à partir de son id
*/
function getRecipeById(PDO $pdo, int $id) {
    $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}


/*
    Récupère toutes les recettes
*/
function getRecipes(PDO $pdo, int $limit = null) {

    $sql = "SELECT * FROM recipes ORDER BY id DESC";

    if ($limit) {
        $sql .= " LIMIT :limit";
    }

    $query = $pdo->prepare($sql);

    if ($limit) {
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }

    $query->execute();
    return $query->fetchAll();
}

/*
    Récupère le chemin complet de l'image de la recette
    ou de l'image par défaut
*/
function getRecipeImage($image) {
    // On test si une donnée est présente sur le champ image
    if ($image == null) {
        //image par défaut
        $imagePath = _PATH_ASSETS_IMAGES_.'recipe_default.jpg';
    } else {
        //image de la recette
        $imagePath =  _PATH_RECIPES_UPLOAD_.$image;
    }
    return $imagePath;
}
