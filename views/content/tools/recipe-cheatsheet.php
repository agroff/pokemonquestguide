<h1>
    <?php o($meta["title"]); ?>
</h1>

<div class="all-recipes">

<?php
foreach($recipes as $recipe):

    if($recipe["attractType"] != "type") continue;

    $recipe["allIngredients"] = $ingredients;

    view("partials/recipe", $recipe);

endforeach;
?>

</div>

<?php //dbg($recipes); ?>

