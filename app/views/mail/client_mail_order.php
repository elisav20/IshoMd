<!doctype html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>

        <table style="width: 100%; margin-bottom: 30px;">
            <tr>
                <td style="font: 32px Georgya, serif;color: #000000;">
                    LUXURY WATCHES
                </td>

                <td style="border: 0px;background: #ffffff;width: 250px;height: 50px;text-align: right;">
                    <div
                        style="padding-top: 10px;line-height: 18px;font-size: 12px;font-family: Arial,sans-serif;color: #bf0000;">
                        Shop - 0(200) 5 31 10
                    </div>
                    <div style="line-height: 18px;font-size: 12px;font-family: Arial,sans-serif;color: #bf0000;">
                        Service-center - 0(200) 3 11 19
                    </div>
                </td>
            </tr>

            <tr>
                <td style="padding: 20px 0; font: 16px Arial, sans-serif;color: #555555;">
                    Hello, <?= $_SESSION['user']['name'] ?>
                </td>
            </tr>

            <tr>
                <td style="font: 22px Arial, sans-serif;color: #555555;">
                    You have placed order on the website ishop.md
                </td>
            </tr>
        </table>

        <table style="border: 1px solid #ddd; border-collapse: collapse; width: 100%;">
            <thead>
                <tr style="background: #f9f9f9;">
                    <th style="padding: 8px; border: 1px solid #ddd;">Name</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Quantity</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Price</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $item) : ?>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['title'] ?></td>
                    <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['qty'] ?></td>
                    <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['price'] ?></td>
                    <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['price'] * $item['qty'] ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">To pay:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">
                        <?= $_SESSION['cart.currency']['symbol_left'] . $_SESSION['cart.sum'] . " {$_SESSION['cart.currency']['symbol_right']}" ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <table
            style="margin-top: 30px; margin-bottom:20px; border: 1px solid #ddd; border-collapse: collapse; width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 200px; padding: 8px; border: 1px solid #ddd;">Date:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;"><?= date('d M, Y G:i') ?></td>
                </tr>
                <tr>
                    <td style="width: 200px; padding: 8px; border: 1px solid #ddd;">Buyer:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;"><?= $_SESSION['user']['name'] ?></td>
                </tr>
                <tr>
                    <td style="width: 200px; padding: 8px; border: 1px solid #ddd;">Email:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;"><?= $_SESSION['user']['email'] ?></td>
                </tr>
                <tr>
                    <td style="width: 200px; padding: 8px; border: 1px solid #ddd;">Delivery address:</td>
                    <td style="padding: 8px; border: 1px solid #ddd;"><?= $_SESSION['user']['address'] ?></td>
                </tr>
            </tbody>
        </table>

    </body>

</html>