<?php

require_once 'lib/config.php';
require_once 'lib/tools.php';
require_once 'lib/pdo.php';
require_once 'lib/recipe.php';
require_once 'lib/category.php';
require_once 'templates/header.php';

$categories = getCategories($pdo);

$errors = [];
$messages = [];

if (isset($_POST['saveRecipe'])) {

    if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] !== '') {
        $checkImage = getimagesize($_FILES['file']['tmp_name']);
        if ($checkImage !== false) {
            $fileName = uniqid().'-'.slugify($_FILES['file']['name']);
            // Si c'est une image, on déplace l'image dans notre dossier
            if (move_uploaded_file($_FILES['file']['tmp_name'], _PATH_RECIPES_UPLOAD_.$fileName)) {

            } else {
                $errors[] = 'Le fichier n\'a pas été uploadé';
            }

        } else {
            $errors[] = 'Le fichier doit être une image';
        }
    }

    if (!$errors) {
        $res = saveRecipe($pdo, $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], (int)$_POST['category_id'], $fileName);
        if ($res) {
            $messages[] = 'La recette a bien été sauvegardée';
        } else {
            $errors[] =  'La recette n\'a pas été sauvegardée';
        }
    }

    
}

?>

<h1>Ajout recette</h1>

<?php foreach($messages as $message) { ?>
    <div class="alert alert-success">
        <?=$message; ?>
    </div>
<?php } ?>

<?php foreach($errors as $error) { ?>
    <div class="alert alert-success">
        <?=$error; ?>
    </div>
<?php } ?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="ingredients" class="form-label">Ingredients</label>
        <textarea class="form-control" name="ingredients" id="ingredients" cols="30" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="instructions" class="form-label">Instructions</label>
        <textarea class="form-control" name="instructions" id="instructions" cols="30" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Ingredients</label>
        <select name="category_id" id="category_id" class="form-select">
            <?php foreach ($categories as $category) { ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="file">Image</label>
        <input type="file" name="file" id="file">
    </div>
    <div class="mb-3">

        <input type="submit" name="saveRecipe" class="btn btn-primary" value="Enregistrer">
    </div>
</form>


<?php require_once 'templates/footer.php'; ?>