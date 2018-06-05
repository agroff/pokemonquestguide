<div class="result" id="prediction-result">
    <div id="result-header">
        <span class="number"><?php o($recipe["id"]); ?></span>
        <h1 class="recipe-name">
            <?php o($recipe["name"]); ?> a la Cube
        </h1>
    </div>

    <div class="result-body">
        <div class="dish-image image-<?php o($recipe["id"]); ?>">
        </div>
        <div class="text">
            <i>
                <?php o($recipe["description"]); ?>
            </i>
        </div>
    </div>
</div>