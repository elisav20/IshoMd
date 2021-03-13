<?php if (!empty($products)) { ?>
<?php $curr = \ishop\App::$app->getProperty('currency'); ?>
<?php foreach ($products as $product) { ?>
<div class="col-md-4 product-left p-left">
    <div class="product-main simpleCart_shelfItem">
        <a href="product/<?= $product['alias']; ?>" class="mask">
            <img class="img-responsive zoom-img" src="images/<?= $product['img']; ?>" alt="" />
        </a>
        <div class="product-bottom">
            <h3> <a href="product/<?= $product['alias']; ?>"><?= $product['title']; ?></a></h3>
            <p> <a href="product/<?= $product['alias']; ?>"> Explore Now</a></p>
            <h4>
                <a data-id="<?= $product['id']; ?>" class="add-to-cart-link"
                    href="cart/add?id=<?= $product['id']; ?>"><i></i></a> <span
                    class=" item_price"><?= $curr['symbol_left']; ?><?= $product['price'] * $curr['value']; ?><?= $curr['symbol_right']; ?></span>
                <?php if ($product['old_price']) : ?>
                <small><del><?= $curr['symbol_left']; ?><?= $product['old_price'] * $curr['value']; ?><?= $curr['symbol_right']; ?></del></small>
                <?php endif; ?>
            </h4>
        </div>
        <?php if ($product['old_price']) { ?>
        <div class="srch srch1">
            <span><?= floor(100 - $product['price'] / $product['old_price'] * 100); ?>%</span>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<div class="clearfix"></div>
<div class="text-center">
    <?php if ($pagination->countPages > 1) {
            echo $pagination;
        } ?>
</div>
<?php } else { ?>
<h3>Products not found ...</h3>
<?php } ?>