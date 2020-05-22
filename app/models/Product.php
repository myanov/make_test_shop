<?php


namespace app\models;


class Product
{
    public function setRecentlyViewed($id)
    {
        $recentlyViewed = $this->getAllRecentlyViewed();
        if(!$recentlyViewed) {
            setcookie('recentlyViewed', $id, time() + 3600 * 24 * 7, '/');
        }
        else {
            $recentlyViewed = explode('.', $recentlyViewed);
            if(!in_array($id, $recentlyViewed)) {
                $recentlyViewed[] = $id;
                $recentlyViewed = implode('.', $recentlyViewed);
                setcookie('recentlyViewed', $recentlyViewed, time() + 3600 * 24 * 7, '/');
            }
        }
    }

    public function getRecentlyViewed()
    {
        $recentlyViewed = $_COOKIE['recentlyViewed'];
        if(!empty($recentlyViewed)) {
            $recentlyViewed = explode('.', $recentlyViewed);
            $lastViewed  = array_splice($recentlyViewed, -3);
            $recentlyProduct = \R::findAll('product', "id IN (". \R::genSlots($lastViewed) .")", $lastViewed);
            return $recentlyProduct;
        }
        return false;
    }

    public function getAllRecentlyViewed()
    {
        if(!empty($_COOKIE['recentlyViewed'])) {
            return $_COOKIE['recentlyViewed'];
        }
        return false;
    }
}