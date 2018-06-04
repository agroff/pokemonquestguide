<h1>
    <?php o($meta["title"]); ?>
</h1>

<div class="hideable-content">
    <p>
        Trying to attract a special Pokemon? This cheat sheet shows several recipes for every
        available pokemon type. Each recipe also has a "Quality" attribute:
    </p>
    <ul class="disc">
        <li>
            <strong>SP:</strong>
            Special recipe take 6 expeditions and attract the rarest pokemon.
        </li>
        <li>
            <strong>VG:</strong>
            Very Good recipes take 5 expeditions and attract the second rarest pokemon.
        </li>
        <li>
            <strong>G:</strong>
            Good recipes take 4 expeditions and attract medium rarity pokemon.
        </li>
        <li>
            <strong>B:</strong>
            Basic recipes take 2 expeditions and attract common rarity pokemon.
        </li>
    </ul>

    <p>
        Higher quality pokemon take longer to attract and their recipes also use
        ingredients that are a lot harder to come by. However, the special pokemon could
        be worth it! Happy cooking!
    </p>

    <p class="warning">
        WARNING: Recipes are not guaranteed to be accurate. We do our best to be accurate
        but mistakes are likely at this early stage of game discovery.
    </p>
</div>


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

