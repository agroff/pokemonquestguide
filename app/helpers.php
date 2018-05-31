<?php

function view($file, $data = []){
    require $_SERVER["DOCUMENT_ROOT"] . "/../views/$file.php";
};
