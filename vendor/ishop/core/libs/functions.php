<?php
function dump($name, bool $die = false) {
    echo '<pre>';
    print_r($name);
    echo '</pre>';
    if($die === true) {
        die();
    }
}