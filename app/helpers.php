<?php

function view($file, $data = [])
{
    extract($data);
    require $_SERVER["DOCUMENT_ROOT"] . "/../views/$file.php";
}


function fullView($file, $data = [])
{
    view("layout/header", $data);
    echo "<div class=\"wrapper\"> \n";
    view($file, $data);
    echo "</div> \n";
    view("layout/footer", $data);
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
        foreach ($content["data"] as $file) {
            $data[$file] = getData($file);
        }
    }

    return $data;
}

function findIngredient($abbreviation, $ingredients)
{
    foreach ($ingredients as $ingredient) {
        if($ingredient["abbreviation"] === $abbreviation){
            return $ingredient;
        }
    }

    return [];
}
function getQualityName($quality)
{
    switch ($quality){
        case "SP":
            return "Special";
        case "VG":
            return "Very Goof";
        case "G":
            return "Good";
        case "B":
            return "Basic";
    }

    return "Unknown";
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

function amountToCount($amount){
    switch ($amount){
        case "alot":
            return "3";
        case "whole-lot":
            return "4-5";
        case "few":
            return "2";
    }

    return "?";
}

function renderIngredientAmount($ingredientType, $amount, $allIngredients)
{
    $amount = trim($amount);
    if($amount === ''){
        return;
    }

    $englishAmount = str_replace("-", " ", $amount);
    $englishAmount = ucwords($englishAmount);
    $englishCount = amountToCount($amount);

    echo "<div class='ingredient-types'>";
    echo $englishAmount . " ($englishCount) of <b>" . ucwords ($ingredientType) . "</b>";
    echo " Ingredients:";
    echo "<div class='ingredient-container tiny'>";
    foreach($allIngredients as $ingredient){
        if($ingredient["attributes"][$ingredientType]){
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
