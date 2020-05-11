<?php


namespace ishop;


use RedBeanPHP\R;

class Db
{
    use TSingleton;

    protected function __construct()
    {
        $db = "";
        if(file_exists(CONF . "/config_db.php")) {
            $db = require_once CONF . "/config_db.php";
        }
        class_alias('\RedBeanPHP\R', '\R');
        R::setup($db["dsn"], $db["user"], $db["password"]);
        if(!\R::testConnection()) {
            throw new \Exception("Нет подключения к базе данных", 500);
        }
        R::freeze(true);
        if(DEBUG === 1) {
            R::debug(true, 1);
        }
    }
}