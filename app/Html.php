<?php

class Html
{
    static function ingredient($nameOrAbbrev)
    {
        $ingredients = Content::get("ingredients");
        $selected = false;

        foreach ($ingredients as $ingredient) {
            if ($nameOrAbbrev === $ingredient["name"]) {
                $selected = $ingredient;
                break;
            }
            if ($nameOrAbbrev === $ingredient["abbreviation"]) {
                $selected = $ingredient;
                break;
            }
        }

        if ($selected === false) {
            echo "Error: Could not find ingredient `$nameOrAbbrev` ";
            return;
        }

        $abbreviation = $selected["abbreviation"];
        $name = $selected["name"];

        echo "<div title=\"$name\" data-id='$abbreviation' class=\"ingredient ingredient-$abbreviation\">
                  <span class=\"show-for-sr\">$name</span>
              </div>";
    }
}
