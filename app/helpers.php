<?php

require "Content.php";
require "Html.php";

function view($file, $data = [])
{
    extract($data);
    require $_SERVER["DOCUMENT_ROOT"] . "/../views/$file.php";
}

function slugify($string){
    $string = strtolower($string);
    $string = str_replace(" ", "-", $string);

    return $string;
}

function getRecipeSlug($recipe)
{
    return recipeSlug($recipe["attracts"], $recipe["name"]);
}

function recipeSlug($attracts, $name)
{
    $typeSegment = $attracts . "-type-pokemon/";
    $nameSegment = $name . ' a la cube';
    return "recipes/" . slugify($typeSegment . $nameSegment);
}

function fullView($file, $data = [])
{
    view("layout/header", $data);
    echo "<div class=\"wrapper\"> \n";
    view($file, $data);
    echo "</div> \n";
    view("layout/footer", $data);
}

function jsonResponse($name)
{
    $data = [
        "status" => 200
    ];
    $data[$name] = getData($name);
    echo json_encode($data);
    die();
}

function getData($name)
{
    $file = $name . '.json';
    $fileContents = file_get_contents('../content/' . $file);
    $value = json_decode($fileContents, true);

    if (!$value) {
        echo "ERROR: Could not parse json for file `$file`: " . json_last_error_msg();
        die();
    }

    return $value;
}

function appendContentData($data, $content)
{
    if (!empty($content["data"])) {
        foreach ($content["data"] as $name) {
            $data[$name] = Content::get($name);
        }
    }

    return $data;
}

function findIngredient($abbreviation, $ingredients)
{
    foreach ($ingredients as $ingredient) {
        if ($ingredient["abbreviation"] === $abbreviation) {
            return $ingredient;
        }
    }

    return [];
}

function getQualityName($quality)
{
    switch ($quality) {
        case "SP":
            return "Special";
        case "VG":
            return "Very Good";
        case "G":
            return "Good";
        case "B":
            return "Basic";
    }

    return "Unknown";
}

function englishRequirements($recipe){
    $string = '';
    foreach ($recipe["ingredients"] as $ingredient => $amount){
        if(trim($amount) !== ''){

            if($string != ''){
                $string .= ' and ';
            }

            $string .= amountToCount($amount) . ' ' .$ingredient . ' ingredients';

        }
    }

    return $string;
}

function englishType($recipe){
    $id = $recipe["id"];
    $type = $recipe["attracts"];
    $type = ucfirst($type);

    if($id >= 6 && $id != 18 ){
        $type .= " Type";
    }

    return $type;
}

function linkTo($name, $linkContents = false)
{
    $content = Content::get("content");


    foreach ($content as $thing) {
        if ($thing["name"] === $name) {

            if (!$linkContents) {
                $linkContents = $thing["title"];
            }

            echo '<a href="/' . $thing["slug"] . '">' . $linkContents . '</a>';
            return;
        }
    }
    echo "ERROR: Could not link to name `$name`";
}

function renderRecipe($recipe, $ingredients)
{
    $recipeString = $recipe["recipe"];

    if (trim($recipeString) === "") {
        return;
    }

    $quality = $recipe["type"];
    $qualityName = "Attracts " . getQualityName($quality) . " Quality Pokemon";

    //echo "<span>$recipeString</span>";

    echo "<div class='ingredient-container tiny spaced'>";

    echo "<div title='$qualityName' class='quality quality-$quality'>";
    echo $quality;
    echo "<span class='show-for-sr'>$qualityName</span>";
    echo "</div>";

    echo "<div class='line'></div>";


    $array = str_split($recipeString);
    foreach ($array as $abbreviation) {
        $ingredient = findIngredient($abbreviation, $ingredients);
        $name = $ingredient["name"];

        echo "<div title='$name' class='ingredient ingredient-$abbreviation'>";
        echo "<span class='show-for-sr'>$name</span>";
        echo "</div>";
    }
    echo "</div>";
}

function recipeLink($id){
    if($id <= 0){
        $id = 18;
    }
    if($id >= 19){
        $id = 1;
    }

    $index = $id - 1;

    $allRecipes = Content::get("recipes");

    $recipe = $allRecipes[$index];

    $slug = getRecipeSlug($recipe);
    echo "<a href='/$slug'>";
    view("partials/recipe-card", [
        "recipe" => $recipe
    ]);
    echo "</a>";
}

function amountToCount($amount)
{
    switch ($amount) {
        case "alot":
            return "3";
        case "whole-lot":
            return "4";
        case "few":
            return "2";
    }

    return "?";
}

function renderIngredientAmount($ingredientType, $amount, $allIngredients)
{
    $amount = trim($amount);
    if ($amount === '') {
        return;
    }

    $englishAmount = str_replace("-", " ", $amount);
    $englishAmount = ucwords($englishAmount);
    $englishCount = amountToCount($amount);
    $englishType = ucwords($ingredientType);

    $explanation = $englishAmount . " ($englishCount) of ";
    $typeExplanation = "<br><b>$englishType</b> Ingredients: ";

    echo "<div class='ingredient-types'>";
    echo "<div class='ingredient-explanation'>";
    echo $explanation . $typeExplanation;
    echo "</div>";
    echo "<div class='ingredient-container tiny'>";
    foreach ($allIngredients as $ingredient) {
        if ($ingredient["attributes"][$ingredientType]) {
            $abbreviation = $ingredient["abbreviation"];
            $name = $ingredient["name"];
            echo "<div title=\"$name\" class=\"ingredient ingredient-$abbreviation\">";
            echo "<span class=\"show-for-sr\">$name</span>";
            echo "</div>";
        }
    }
    echo "</div>";
    echo "</div>";
}

function dbg($var)
{
    var_dump($var);
}

function o($string)
{
    echo htmlspecialchars($string);
}
