<?php

namespace app\controllers;

use app\models\breadcrumbs;
use app\models\Category;
use app\widgets\filter\Filter;
use ishop\App;
use ishop\libs\Pagination;
use R;

class CategoryController extends AppController
{

    public function viewAction()
    {
        $alias = $this->route['alias'];
        $category = \R::findOne('category', 'alias = ?', [$alias]);

        if (!$category) {
            throw new \Exception('Page not found', 404);
        }

        //breadcrumbs
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category['id']);

        $catModel = new Category();
        $ids = $catModel->getIds($category['id']);
        $ids = null ? $category['id'] : $ids . $category['id'];

        //pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = App::$app->getProperty('pagination');

        $sqlPart = '';
        if (!empty($_GET['filter'])) {
            $filter = Filter::getFilter();

            if ($filter) {
                $cnt = Filter::getCountGroups($filter);
                $sqlPart = "AND id IN (SELECT product_id FROM attribute_product WHERE attr_id IN ($filter) GROUP BY product_id HAVING COUNT(product_id) = $cnt)";
            }
        }

        $total = \R::count('product', "category_id IN ($ids) $sqlPart");
        $pagination = new Pagination($page, $perPage, $total);
        $start = $pagination->getStart();

        $products = \R::find('product', "category_id IN ($ids) $sqlPart LIMIT $start, $perPage");

        if ($this->isAjax()) {
            $this->loadView('filter', compact('products', 'pagination'));
        }

        $this->setMeta($category['title'], $category['description'], $category['keywords']);
        $this->set(compact('products', 'breadcrumbs', 'pagination'));
    }
}