<?php


namespace ishop;


class ErrorHandler
{
    public function __construct()
    {
        if(DEBUG === 1) {
            error_reporting(-1);
        }else {
            error_reporting(0);
        }
        set_exception_handler([$this, "exceptionHandler"]);
    }

    public function exceptionHandler($e)
    {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError("Исключение ", $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    private function logError($message = '', $file = '', $line = '')
    {
        error_log("[" . date("d-m-Y H:i:s") . "]" . " Сообщение: " . $message . " Файл: " . $file .
            " Строка: " . $line . "\n==============\n", 3, ROOT . "/tmp/errors_log.txt");
    }

    private function displayError($errno, $errstr, $errfile, $errline, $responce = 404)
    {
        if($responce == 404 && DEBUG !== 1) {
            require WWW . "/errors/404.php";
        }
        elseif(DEBUG === 1) {
            require WWW . "/errors/dev.php";
        }
        else {
            require WWW . "/errors/prod.php";
        }
    }
}