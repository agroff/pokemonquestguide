<h1>
    <?php o($meta["title"]); ?>
</h1>

<div class="hideable-content">
    <p>
        Don't waste your precious ingredients! Use our cooking simulator to see what
        recipe
        you're gonna get before you start cooking.
    </p>

    <p>
        Just click on the ingredients you want to use to put them in the pot. Once it's
        full we'll give you our best guess on what you're gonna create. When you're happy
        with your recipe, click "Start Cooking."
    </p>

    <p>
        We'll remember what recipes you made, and when they're finished you can come back
        and tell us what you got. This will help us understand recipes better, and you can
        come always see how you attracted your best pokemon.
    </p>

    <p>
        Currently, we don't have enough data to use the rainbow ingredients in this
        simulator.
    </p>

    <p class="warning">
        WARNING: Recipes are not guaranteed to be accurate. We do our best to be accurate
        but mistakes are likely at this early stage of game discovery.
    </p>
</div>

<div class="cooking-simulator-container">

    <div class="row">
        <div class="medium-7 columns">
            <div class="cooking-pot">
                <div class="slot slot-1"></div>
                <div class="slot slot-2"></div>
                <div class="slot slot-3"></div>
                <div class="slot slot-4"></div>
                <div class="slot slot-5"></div>
            </div>

            <div class="ingredient-container simulator-ingredients spaced">
                <?php Html::ingredient('T') ?>
                <?php Html::ingredient('B') ?>
                <?php Html::ingredient('A') ?>
                <?php Html::ingredient('F') ?>
            </div>
            <div class="ingredient-container simulator-ingredients spaced">
                <?php Html::ingredient('R') ?>
                <?php Html::ingredient('I') ?>
                <?php Html::ingredient('H') ?>
                <?php Html::ingredient('M') ?>
            </div>

            <h4>Prediction</h4>
            <div class="result" id="prediction-result">
                <h4 id="result-header">
                    <span class="number">1</span>
                    <span id="recipe-name">Needs more Ingredients</span>

                </h4>

                <div class="result-body">
                    <div id="dish-image">

                    </div>
                    <div class="text">
                        Attracts
                        <span id="pokemon-quality">N/A</span>
                        <span id="pokemon-type">N/A</span>
                        Pokemon.
                        <br>
                        Requires <span id="expeditions">N/A</span>
                        expeditions.
                    </div>
                </div>

                <div id="rarity-indicator"></div>

            </div>

            <button id="cook-button" class="game disabled">Start Cooking</button>

            <hr>
        </div>
        <div class="medium-5 columns">
            <h4>Past Recipes</h4>

            <div class="pastRecipes">
                Nothing cooked yet.
            </div>
        </div>
    </div>

</div>
