<?php

namespace app\controllers;

use app\models\breadcrumbs;
use app\models\Product;

class ProductController extends AppController
{

    public function viewAction()
    {
        $alias = $this->route['alias'];
        $product = \R::findOne('product', "alias = ? AND status = '1'", [$alias]);

        if (!$product) {
            throw new \Exception('Page not found', 404);
        }

        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product['category_id'], $product['title']);

        $related = \R::getAll(
            "SELECT * 
            FROM related_product 
            JOIN product ON related_product.related_id = product.id 
            WHERE related_product.product_id = ?",
            [$product['id']]
        );

        $pModel = new Product();
        $pModel->setRecentlyViewed($product['id']);

        $rViewed = $pModel->getRecentlyViewed();
        $recentlyViewed = null;

        if ($rViewed) {
            $recentlyViewed = \R::find('product', 'id IN (' . \R::genSlots($rViewed) . ') LIMIT 3', $rViewed);
        }

        $gallery = \R::findAll('gallery', 'product_id = ?', [$product['id']]);

        $mods = \R::findAll('modification', 'product_id = ?', [$product['id']]);

        $this->setMeta($product['title'], $product['description'], $product['keywords']);
        $this->set(compact('product', 'related', 'gallery', 'recentlyViewed', 'breadcrumbs', 'mods'));
    }
}