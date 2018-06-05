

<div class="row">
    <div class="medium-6 columns" style="padding-right:10px">

        <div class="result" id="prediction-result">
            <div id="result-header">
                <span class="number"><?php o($recipe["id"]); ?></span>
                <h1 id="recipe-name">
                    <?php o($recipe["name"]); ?> a la Cube
                </h1>
            </div>

            <div class="result-body">
                <div id="dish-image" class="image-<?php o($recipe["id"]); ?>">
                </div>
                <div class="text">
                    <i>
                        <?php o($recipe["description"]); ?>
                    </i>
                </div>
            </div>
        </div>

        <p>
            If you're trying to catch <?php o(englishType($recipe)); ?> pokemon in Pokemon
            quest, <?php o($recipe["name"]); ?> a la Cube is the recipe you'll want to use.
        </p>

        <p>
            The recipe requires <?php o(englishRequirements($recipe)); ?>, but it's
            best to use recipes from our known recipe list since sometimes meeting all the
            requirements for this recipe will also meet the requirements for another recipe
            and you'll get the wrong type of pokemon.
        </p>

        <p>
            If you're looking for info about other pokemon quest recipes, check out our
            handy <?php linkTo("recipe-cheatsheet", "Recipe Cheatsheet") ?>.
        </p>

        <h6>Ingredients:</h6>
        <?php foreach ($recipe["ingredients"] as $ingredient => $amount): ?>
            <?php renderIngredientAmount($ingredient, $amount, $allIngredients); ?>
        <?php endforeach; ?>


    </div>
    <div class="medium-6 columns">
        <h4>Known Recipes</h4>
        <div class="recipes">
            <?php foreach ($recipe["knownRecipes"] as $known): ?>
                <?php renderRecipe($known, $allIngredients); ?>
            <?php endforeach; ?>
        </div>

        <h4>Known Pokemon</h4>
        <p>List of pokemon for <?php o($recipe["name"]); ?> a la Cube is coming soon!</p>
    </div>

</div>

<br>
<h5>You might also be interested in:</h5>
<div class="row">
    <div class="medium-6 columns">
        <?php recipeLink($recipe["id"] - 1); ?>
    </div>

    <div class="medium-6 columns">
        <?php recipeLink($recipe["id"] + 1); ?>
    </div>
</div>

