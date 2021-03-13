<?php

namespace app\models;

use ishop\App;
use R;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Order extends AppModel
{
    public $attributes = [
        'user_id'   => '',
        'currency'  => '',
        'note'      => '',
    ];

    public static function saveOrder($data)
    {
        $order = \R::dispense('order');
        $order->user_id = $data['user_id'];
        $order->note = $data['note'];
        $order->currency = $_SESSION['cart.currency']['code'];
        $orderId = \R::store($order);
        self::saveOrderProduct($orderId);
        return $orderId;
    }

    public static function saveOrderProduct($orderId)
    {
        $sqlPart = '';

        foreach ($_SESSION['cart'] as $productId => $product) {
            $productId = (int) $productId;
            $sqlPart .= "($orderId, $productId, {$product['qty']}, '{$product['title']}', {$product['price']}),";
        }
        $sqlPart = rtrim($sqlPart, ',');

        \R::exec("INSERT INTO order_product (order_id, product_id, qty, title, price) VALUES $sqlPart");
    }

    public static function mailOrder($orderId, $email)
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport(
            App::$app->getProperty('smtp_host'),
            App::$app->getProperty('smtp_port'),
            App::$app->getProperty('smtp_protocol')
        ))
            ->setUsername(App::$app->getProperty('smtp_login'))
            ->setPassword(App::$app->getProperty('smtp_password'));

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message for client
        ob_start();
        require(APP . '/views/mail/client_mail_order.php');
        $body = ob_get_clean();

        $messageClient = (new Swift_Message("You have placed order №{$orderId} on the website ishop.md"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo($email)
            ->setBody($body, 'text/html');

        // Send the message to client
        $mailer->send($messageClient);

        // Create a message for admin
        ob_start();
        require(APP . '/views/mail/admin_mail_order.php');
        $body = ob_get_clean();

        $messageAdmin = (new Swift_Message("New Order №{$orderId}"))
            ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
            ->setTo(App::$app->getProperty('admin_email'))
            ->setBody($body, 'text/html');

        // Send the message to admin
        $mailer->send($messageAdmin);

        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.currency']);

        $_SESSION['success'] = 'Thank you for your order. In the near future a manager will contact you to agree on an order.';
    }
}