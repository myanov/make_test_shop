<?php


namespace app\controllers;


use ishop\App;

class ProductController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        if($alias) {
            $product = \R::findOne('product', "alias = ? AND status = '1'", [$alias]);
        }
        if(!$product) {
            throw new \Exception("Продукта $alias не найдено", 404);
        }
        $this->setMeta($product->title, $product->keywords, $product->description);
        $this->set(compact('product'));
    }
}