<?php
function dump($name, bool $die = false) {
    echo '<pre>';
    print_r($name);
    echo '</pre>';
    if($die === true) {
        die();
    }
}

function redirect($path = false) {
    if($path) {
        $location = $path;
    }
    else {
        $location = $_SERVER["HTTP_REFERER"] ? $_SERVER["HTTP_REFERER"] : PATH;
    }
    header("Location: " . $location);
    die();
}