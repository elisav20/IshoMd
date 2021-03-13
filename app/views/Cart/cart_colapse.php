<?php if (!empty($_SESSION['cart'])) { ?>
<span class="js-cart-sum" hidden>
    <?= $_SESSION['cart.currency']['symbol_left'] . $_SESSION['cart.sum'] . $_SESSION['cart.currency']['symbol_right'] ?>
</span>

<div class="colapse-cart__wrapper">
    <?php foreach ($_SESSION['cart'] as $id => $item) { ?>
    <div class="colapse-cart__item">
        <div class="colapse-cart__body">
            <div class="colapse-cart__img">
                <img src="images/<?= $item['img'] ?>" alt="<?= $item['title']; ?>">
            </div>
            <div class="colapse-cart__info">
                <div class="colapse-cart__title">
                    <a href="product/<?= $item['alias']; ?> />">
                        <?= $item['title']; ?>
                    </a>
                    <span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger js-del-item"
                        aria-hidden="true" style="cursor: pointer;">
                    </span>
                </div>
                <div class="colapse-cart__sum">
                    <span class="text-right cart-qty">
                        <?= $item['qty'] ?>X -
                    </span>
                    <?= $_SESSION['cart.currency']['symbol_left'] . ($item['price'] * $item['qty']) . $_SESSION['cart.currency']['symbol_right'] ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<div class="colapse-cart__footer">
    <div class="text-right">
        <button id="js-continue-shop-btn" type="button" class="btn btn-secondary">Continue shop</button>
        <a href="cart/view" class="btn btn-primary">Make order</a>
    </div>
</div>

<?php } else { ?>
<h3>Cart is empty</h3>
<?php } ?>