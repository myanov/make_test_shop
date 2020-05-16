<?php


namespace app\controllers;


use ishop\App;

class CurrencyController extends AppController
{

    public function changeAction()
    {
        $curr = $_GET['curr'];
        if($curr) {
            if(array_key_exists($curr, App::$app->getProperty('currencies'))) {
                setcookie('currency', $curr, time() + 3600 * 24 * 7, '/');
            }
        }
        redirect();
    }

}