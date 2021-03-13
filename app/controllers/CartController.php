<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\User;

class CartController extends AppController
{
    public function addAction()
    {
        $id = !empty($_GET['id']) ? (int) $_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int) $_GET['qty'] : null;
        $modId = !empty($_GET['mod']) ? (int) $_GET['mod'] : null;
        $mod = null;

        if ($id) {
            $product = \R::findOne('product', 'id = ?', [$id]);

            if (!$product) {
                return false;
            }

            if ($modId) {
                $mod = \R::findOne('modification', 'id = ? AND product_id = ?', [$modId, $id]);
            }
        }

        $cart = new Cart();
        $cart->addToCart($product, $qty, $mod);

        if ($this->isAjax()) {
            $this->loadView('cart_colapse');
        }
        redirect();
    }

    public function showAction()
    {
        $this->loadView('cart_modal');
    }

    public function deleteAction()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        $isModal = !empty($_GET['is_modal']) ? $_GET['is_modal'] : 0;

        if (isset($_SESSION['cart'][$id])) {
            $cart = new Cart();
            $cart->deleteItem($id);
        }

        if ($this->isAjax()) {
            if ($isModal) {
                $this->loadView('cart_modal');
            } else {
                $this->loadView('cart_colapse');
            }
        }
        redirect();
    }

    public function clearAction()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.currency']);

        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function viewAction()
    {
        $this->setMeta('Cart');
    }

    public function checkoutAction()
    {
        if (!empty($_POST)) {
            if (!User::checkAuth()) {
                $user = new User();
                $data = $_POST;
                $user->load($data);

                if (!$user->validate($data) || !$user->checkUnique()) {
                    $user->getErrors();
                    $_SESSION['form_data'] = $data;
                    redirect();
                } else {
                    $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);

                    if (!$userId = $user->save('user')) {
                        $_SESSION['success'] = 'Error!';
                        redirect();
                    }
                }
            }

            $data['user_id'] = isset($userId) ? $userId : $_SESSION['user']['id'];
            $data['note'] = !empty($_POST['note']) ? h($_POST['note']) : '';
            $userEmail = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : $_POST['email'];
            $orderId = Order::saveOrder($data);
            Order::mailOrder($orderId, $userEmail);
        }
        redirect();
    }
}