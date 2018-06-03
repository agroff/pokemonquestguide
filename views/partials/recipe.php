<div class="recipe-container">
    <h5 class="<?php o($attracts); ?> attract-header">
        <?php o(ucwords($attracts)); ?> Pokemon
        <br>
        <span class="recipe-name">
            <?php o($name); ?>
        </span>

        <a class="expand-button" href="javascript:void(0);">+</a>
    </h5>

    <p class="only-expanded"><?php o($description); ?></p>

    <div class="recipes">
        <?php foreach ($knownRecipes as $known): ?>
            <?php renderRecipe($known, $allIngredients); ?>
        <?php endforeach; ?>
    </div>

    <div class="ingredients only-expanded">

        <h6>Ingredients</h6>
        <?php foreach ($ingredients as $ingredient => $amount): ?>
            <?php renderIngredientAmount($ingredient, $amount, $allIngredients); ?>
        <?php endforeach; ?>
    </div>


</div>