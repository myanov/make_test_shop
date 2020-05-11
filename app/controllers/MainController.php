<?php


namespace app\controllers;


use ishop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $this->setMeta("Index", "Index page", "Test meta for Main index page");
        $posts = \R::findAll('test');
        $name = "Maksim";
        $arr = [1, 2, 3, 4];
        $data = Cache::get('test');
        if($data === false) {
            Cache::set('test', $arr);
            $data = Cache::get('test');
        }
        $age = 21;
        $properties = ["height" => 180, "weight" => 68];
        $this->set(compact('name', 'age', 'properties', 'posts', 'data'));
    }
}