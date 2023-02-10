<div class="col-md-4 my-2 d-flex">
    <div class="card">
        <img src="uploads/recipes/<?= $recipe['image'] ?>" class="card-img-top" alt="<?= $recipe['title']; ?>">

        <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= $recipe['title'] ?></h5>
            <p class="card-text"><?= $recipe['description'] ?></p>
            <div class="mt-auto">
                <a href="recette.php?id=<?=$index;?>" class="btn btn-primary">Voir la recette</a>
            </div>
        </div>
    </div>
</div>