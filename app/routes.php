<?php

require "helpers.php";

$uri = $_SERVER["REQUEST_URI"];

$uri = trim($uri, '/');
$uri = strtolower($uri);

if($uri === '') {
    //$uri = 'index';
}

//dbg($uri);


$data = [];
$data["meta"] = [
    "title" => "Unofficial guide to pokemon quest",
    "description" => "Learn everything about how to play the new Nintendo Switch Pokemon game. Tips for free to play strategy, cooking recipes, and more!"
];

$allContent = json_decode(file_get_contents('../content/content.json'), true);

foreach($allContent as $content){

    if($content["slug"] === $uri){
        $path = "content/" . $content["category"] . "/" . $content["name"];

        $data["meta"] = array_merge($data["meta"], $content);

        fullView($path, $data);

        die();
    }
}

if($uri === 'index') {
    view("index", $data);
    die();
}

http_response_code(404);
echo "404 not found."; // provide your own HTML for the error page
die();
