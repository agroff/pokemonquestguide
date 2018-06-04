$(function () {

    var ingredients = [];
    var recipes = [];

    var slots = [
        false,
        false,
        false,
        false,
        false
    ];

    var getOpenSlot = function () {
        var slot = false;
        slots.forEach(function (value, index) {
            if (!value && !slot) {
                slot = index + 1;

            }
        });

        return slot;
    };

    var cloneIngredient = function ($ingredient) {
        var $clone = $ingredient.clone(),
            abbreviation = $ingredient.attr("data-id"),
            openSlot = getOpenSlot(),
            $slot = $(".slot-" + openSlot),
            start = $ingredient.offset(),
            end = $slot.offset();

        $clone.css({
            "position": "absolute",
            "top": start.top,
            "left": start.left
        });

        $("body").append($clone);

        $clone.addClass("animate-ingredient");

        setTimeout(function () {
            $clone.css({
                "top": end.top,
                "left": end.left
            });
        }, 10);


        slots[openSlot - 1] = abbreviation;

        $clone.click(function () {
            slots[openSlot - 1] = false;
            $(this).remove();
            renderRecipe();
        });

        return $clone;
    };

    var amountToCount = function (amount) {
        switch (amount) {
            case "whole-lot":
                return 4;
            case "alot":
                return 3;
            case "few":
                return 2;
            case "little":
                return 1;
        }

        console.error("Unknown amount: " + amount);
    };

    var getRecipeNeeds = function (ingredients) {
        var needs = {};

        $.each(ingredients, function (type, amount) {
            amount = $.trim(amount);
            if (amount !== '') {
                needs[type] = amountToCount(amount);
            }
        });

        return needs;
    };

    var abbreviationToIngredient = function (abbreviation) {
        var selected = false;
        $.each(ingredients, function (i, ingredient) {
            if (ingredient.abbreviation === abbreviation) {
                selected = ingredient;
            }
        });

        return selected;
    };

    var getRecipeHas = function () {
        var has = {};
        slots.forEach(function (abbreviation) {
            var ingredient = abbreviationToIngredient(abbreviation);

            $.each(ingredient.attributes, function (type, hasType) {
                if (hasType) {
                    if (!has.hasOwnProperty(type)) {
                        has[type] = 0;
                    }
                    has[type] += 1;
                }
            });

        });

        return has;
    };

    var predictRecipe = function () {
        var has = getRecipeHas();

        var match = false;

        $.each(recipes, function (i, recipe) {
            var needs = getRecipeNeeds(recipe.ingredients),
                matches = true;

            //dont match mulligan
            if (i === 0) {
                matches = false;
            }

            $.each(needs, function (type, count) {
                if (!has.hasOwnProperty(type)) {
                    has[type] = 0;
                }
                if (has[type] < count) {
                    matches = false;
                }
            });

            if (match === false) {
                if (matches) {
                    match = recipe;
                }
            }
        });

        if (match === false) {
            match = recipes[0];
        }

        return match;
    };

    var getRecipeQuality = function () {
        var quality = 0;
        slots.forEach(function (abbreviation) {
            var ingredient = abbreviationToIngredient(abbreviation);
            quality += ingredient.quality;
        });

        return quality;
    };

    var getEnglishQuality = function (quality) {
        if(quality >= 10){
            return "Special";
        }
        if(quality >= 8){
            return "Very Good";
        }
        if(quality >= 6){
            return "Good";
        }
        return "Basic";
    };

    var capitalize = function(string){
            return string.charAt(0).toUpperCase() + string.slice(1);
    };

    var qualityToExpeditions = function (quality) {
        if(quality >= 10){
            return 6;
        }
        if(quality >= 8){
            return 5;
        }
        if(quality >= 6){
            return 4;
        }
        return 2;
    };

    var renderRecipe = function () {
        var openSlot = getOpenSlot(),
            name = "Needs more Ingredients",
            type = "N/A",
            cssClass = "none",
            number = 0,
            $cookButton = $("#cook-button"),
            quality = getRecipeQuality(),
            englishQuality = getEnglishQuality(quality),
            expeditions = qualityToExpeditions(quality);

        if (openSlot === false) {
            var recipe = predictRecipe();
            $cookButton.removeClass("disabled");
            name = recipe.name + " A La Cube";
            number = recipe.number;
            cssClass = recipe.name.replace(/\s+/,'-').toLowerCase();
            type = capitalize(recipe.attracts);
            $("#prediction-result").removeClass('none');
        }
        else {
            expeditions = "N/A";
            englishQuality = "none";
            $cookButton.addClass("disabled");
            $("#prediction-result").addClass('none');
        }
        $("#recipe-name").text(name);
        $("#pokemon-quality").text(englishQuality);
        $("#pokemon-type").text(type);
        $(".number").text(number);
        $("#expeditions").text(expeditions);
        $("#dish-image").attr("class",'image-'+number);
        $("#rarity-indicator").attr("class", englishQuality.replace(/\s+/,'-').toLowerCase());

    };

    var addIngredient = function ($ingredient) {
        var slot = cloneIngredient($ingredient);

        renderRecipe();
    };

    var getIngredients = function (callback) {
        var cb = callback || function () {
        };

        $.getJSON("/ajax/ingredients", function (data) {
            ingredients = data.ingredients;
            cb();
        });
    };

    var getRecipes = function (callback) {
        var cb = callback || function () {
        };

        $.getJSON("/ajax/recipes", function (data) {
            recipes = data.recipes;

            $.each(recipes, function(i,item){
                item["number"] = i +1;
                recipes[i] = item;
            });
            cb();
        });
    };

    var renderPastRecipes = function(){
        var html = '';
        PQG.db.recipes.forEach(function(recipe){
            var letters = recipe.recipe.split("");
            html += '<div class="past-recipe">';
            html += '<div class="ingredient-container tiny spaced">';
            letters.forEach(function(letter){
                html += '<div class="ingredient ingredient-'+letter+'"></div>';
            });
            html += '</div>';
            html += 'Prediction: ' + recipe.quality +' quality ' + recipe.type + ' pokemon';
            html += ' in ' + recipe.expeditions + ' expeditions';
            html += '</div>';
        });

        if(PQG.db.recipes.length == 0){
            html = "Nothing cooked yet.";
        }

        $(".pastRecipes").html(html);
    };

    var clearRecipe = function(){
        slots = [false, false, false, false, false];
        $(".animate-ingredient").remove();
        renderRecipe();
    };

    var init = function () {
        $(".simulator-ingredients").on("click", ".ingredient", function () {
            addIngredient($(this));
        });

        $("#cook-button").click(function(){
            var recipe = predictRecipe(),
            quality = getRecipeQuality();

            PQG.db.recipes.push({
                recipe : slots.join(""),
                quality : getEnglishQuality(quality),
                type : recipe.attracts,
                expeditions : qualityToExpeditions(quality)
            });

            PQG.saveDb();

            renderPastRecipes();
            clearRecipe();
        });

        getIngredients(function () {
            getRecipes(function () {
                renderRecipe();
                renderPastRecipes();
            });
        });
    };

    init();
});