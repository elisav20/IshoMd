<!--banner-starts-->
<div class="bnr" id="home">
    <div id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/bnr-1.jpg" alt="" />
            </li>
            <li>
                <img src="images/bnr-2.jpg" alt="" />
            </li>
            <li>
                <img src="images/bnr-3.jpg" alt="" />
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!--banner-ends-->

<!--about-starts-->
<?php if ($brands) { ?>
<div class="about">
    <div class="container">
        <div class="about-top grid-1">
            <?php foreach ($brands as $brand) { ?>
            <div class="col-md-4 about-left">
                <figure class="effect-bubba">
                    <img class="img-responsive" src="images/<?= $brand['img']; ?>" alt="<?= $brand['title']; ?>" />
                    <figcaption>
                        <h2><?= $brand['title']; ?></h2>
                        <p><?= $brand['description']; ?></p>
                    </figcaption>
                </figure>
            </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<?php } ?>
<!--about-end-->

<!--product-starts-->
<?php if ($hits) { ?>
<?php $curr = \ishop\App::$app->getProperty('currency'); ?>
<div class="product">
    <div class="container">
        <div class="product-top">
            <div class="product-one">
                <?php foreach ($hits as $hit) { ?>
                <div class="col-md-3 product-left">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="product/<?= $hit['alias']; ?>" class="mask">
                            <img class="img-responsive zoom-img" src="images/<?= $hit['img']; ?>"
                                alt="<?= $hit['title']; ?>" />
                        </a>
                        <div class="product-bottom">
                            <h3>
                                <a href="product/<?= $hit['alias']; ?>"><?= $hit['title']; ?></a>
                            </h3>
                            <p><a href="product/<?= $hit['alias']; ?>">Explore Now</a></p>
                            <h4>
                                <a class="add-to-cart-link" data-id="<?= $hit['id'] ?>"
                                    href="cart/add?id=<?= $hit['id'] ?>"><i></i></a>
                                <span class=" item_price">
                                    <?= $curr['symbol_left']; ?>
                                    <?= round($hit['price'] * $curr['value'], 2); ?>
                                    <?= $curr['symbol_right']; ?>
                                </span>
                                <?php if ($hit['old_price']) { ?>
                                <small>
                                    <del>
                                        <?= $curr['symbol_left']; ?>
                                        <?= round($hit['old_price'] * $curr['value'], 2); ?>
                                        <?= $curr['symbol_right']; ?>
                                    </del>
                                </small>
                                <?php } ?>
                            </h4>
                        </div>
                        <?php if ($hit['old_price']) { ?>
                        <div class="srch">
                            <span><?= floor(100 - $hit['price'] / $hit['old_price'] * 100); ?>%</span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <div class=" clearfix">
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!--product-end-->