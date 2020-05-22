<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Product;
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

        // Breadcrumbs
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);

        // Related products
        $related = \R::getAll("SELECT * FROM related_product JOIN product ON related_product.related_id = product.id
                                    WHERE related_product.product_id = ?", [$product->id]);
        // Write to cookie requested product
        $m_product = new Product();
        $m_product->setRecentlyViewed($product->id);

        // Watched products
        $recentlyProduct = $m_product->getRecentlyViewed();

        // Gallery
        $gallery = \R::findAll("gallery", "product_id = ?", [$product->id]);

        // Modifications
        $this->set(compact('product', 'related', 'gallery', 'recentlyProduct', 'breadcrumbs'));
    }
}