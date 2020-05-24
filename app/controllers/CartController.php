<?php


namespace app\controllers;


use ishop\App;

class CartController extends AppController
{
    public function addAction()
    {
        $id = $_GET['id'] ? (int)$_GET['id'] : null;
        $qty = $_GET['qty'] ? (int)$_GET['qty'] : null;
        $mod_id = $_GET['mod'] ? (int)$_GET['mod'] : null;
        $mod = null;

        if($id) {
            $product = \R::findOne("product", "id = ?", [$id]);
            if(!$product) {
                return false;
            }

            if($mod_id) {
                $mod = \R::findOne("modification", "id = ? AND product_id = ?", [$mod_id, $product["id"]]);
            }
            dump($mod);
        }
        die;
    }
}