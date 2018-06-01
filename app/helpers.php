<?php

function view($file, $data = []){
    extract($data);
    require $_SERVER["DOCUMENT_ROOT"] . "/../views/$file.php";
};

function fullView($file, $data = []){
    view("layout/header", $data);
    echo "<div class=\"wrapper\"> \n";
    view($file, $data);
    echo "</div> \n";
    view("layout/footer", $data);
};

function dbg($var){
    var_dump($var);
}

function o($string){
    echo htmlspecialchars($string);
}
