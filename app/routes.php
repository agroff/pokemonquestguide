<?php

require "helpers.php";

$uri = $_SERVER["REQUEST_URI"];

//echo $uri;

if($uri !== '/'){
    http_response_code(404);
    echo "404 not found."; // provide your own HTML for the error page
    die();
}


view("index");

die();

?>