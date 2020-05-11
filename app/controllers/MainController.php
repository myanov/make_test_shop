<?php


namespace app\controllers;


use ishop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $this->setMeta("Главная страница", "Main page of luxury watches",
            "Test  meta for Main index page");
        $brands = \R::find('brand', "LIMIT 3");
        $hits = \R::find('product', "hit='1' AND status='1' LIMIT 8");
        $this->set(compact('brands', 'hits'));
    }
}