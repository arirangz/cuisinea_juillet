<?php


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