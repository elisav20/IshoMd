<!DOCTYPE html>
<html>

    <head>
        <base href="/">
        <link rel="shortcut icon" href="images/shops.png" type="image/png">
        <?= $this->getMeta(); ?>
        <!--//theme-style-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
            integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="megamenu/css/ionicons.min.css" rel="stylesheet" type="text/css" media="all" />
        <link href="megamenu/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>

    <body>
        <!--top-header-->
        <div class="top-header">
            <div class="container">
                <div class="top-header-main">
                    <div class="col-md-6 top-header-left">
                        <div class="drop">
                            <div class="box">
                                <select id="currency" tabindex="4" class="dropdown drop">
                                    <?php new \app\widgets\currency\Currency(); ?>
                                </select>
                            </div>

                            <div class="btn-group">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if (!empty($_SESSION['user'])) { ?>
                                    <li>
                                        <a href="#">Hello, <?php echo h($_SESSION['user']['name']) ?></a>
                                    </li>
                                    <li>
                                        <a href="user/logout">Logout</a>
                                    </li>
                                    <?php } else { ?>
                                    <li>
                                        <a href="user/login">Login</a>
                                    </li>
                                    <li>
                                        <a href="user/signup">SignUp</a>
                                    </li>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-6 top-header-left">
                        <div class="cart box_1">
                            <a href="cart/show" id="js-show-cart">
                                <div class="total">
                                    <img src="images/cart-1.png" alt="" />
                                    <div>
                                        <?php if (!empty($_SESSION['cart'])) { ?>
                                        <div class="simpleCart_total">
                                            <?= $_SESSION['cart.currency']['symbol_left']; ?>
                                            <?= $_SESSION['cart.sum']; ?>
                                            <?= $_SESSION['cart.currency']['symbol_right']; ?>
                                        </div>
                                        <?php } else { ?>
                                        <div class="simpleCart_total">Empty Cart</div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </a>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--top-header-->
        <!--start-logo-->
        <div class="logo">
            <a href="<?= SITE_URL; ?>">
                <h1>Luxury Watches</h1>
            </a>
        </div>
        <!--start-logo-->
        <!--bottom-header-->
        <div class="header-bottom">
            <div class="container">
                <div class="header">
                    <div class="col-md-9 header-left">
                        <div class="menu-container">
                            <div class="menu">
                                <?php new \app\widgets\menu\Menu([
                                'tpl' => WWW . '/menu/menu.php',
                            ]); ?>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-md-3 header-right">
                        <div class="search-bar">
                            <form action="search" method="GET" autocomplete="off">
                                <input type="text" class="typeahead" id="typeahead" name="s">
                                <input type="submit" value="">
                            </form>
                            <!-- <input type="text" value="Search" onfocus="this.value = '';"
                                onblur="if (this.value == '') {this.value = 'Search';}">
                            <input type="submit" value=""> -->
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <!--bottom-header-->

        <div class="colapse-cart" id="js-colapse-cart">
        </div>

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                        <?php } ?>
                        <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?= $content; ?>
        </div>

        <!--information-starts-->
        <div class="information">
            <div class="container">
                <div class="infor-top">
                    <div class="col-md-3 infor-left">
                        <h3>Follow Us</h3>
                        <ul>
                            <li><a href="#"><span class="fb"></span>
                                    <h6>Facebook</h6>
                                </a></li>
                            <li><a href="#"><span class="twit"></span>
                                    <h6>Twitter</h6>
                                </a></li>
                            <li><a href="#"><span class="google"></span>
                                    <h6>Google+</h6>
                                </a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 infor-left">
                        <h3>Information</h3>
                        <ul>
                            <li><a href="#">
                                    <p>Specials</p>
                                </a></li>
                            <li><a href="#">
                                    <p>New Products</p>
                                </a></li>
                            <li><a href="#">
                                    <p>Our Stores</p>
                                </a></li>
                            <li><a href="contact.html">
                                    <p>Contact Us</p>
                                </a></li>
                            <li><a href="#">
                                    <p>Top Sellers</p>
                                </a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 infor-left">
                        <h3>My Account</h3>
                        <ul>
                            <li><a href="account.html">
                                    <p>My Account</p>
                                </a></li>
                            <li><a href="#">
                                    <p>My Credit slips</p>
                                </a></li>
                            <li><a href="#">
                                    <p>My Merchandise returns</p>
                                </a></li>
                            <li><a href="#">
                                    <p>My Personal info</p>
                                </a></li>
                            <li><a href="#">
                                    <p>My Addresses</p>
                                </a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 infor-left">
                        <h3>Store Information</h3>
                        <h4>The company name,
                            <span>Lorem ipsum dolor,</span>
                            Glasglow Dr 40 Fe 72.
                        </h4>
                        <h5>+955 123 4567</h5>
                        <p><a href="mailto:example@email.com">contact@example.com</a></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--information-end-->
        <!--footer-starts-->
        <div class="footer">
            <div class="container">
                <div class="footer-top">
                    <div class="col-md-6 footer-left">
                        <form>
                            <input type="text" value="Enter Your Email" onfocus="this.value = '';"
                                onblur="if (this.value == '') {this.value = 'Enter Your Email';}">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                    <div class="col-md-6 footer-right">
                        <p>© 2015 Luxury Watches. All Rights Reserved | Design by <a href="http://w3layouts.com/"
                                target="_blank">W3layouts</a> </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--footer-end-->

        <!-- Modal -->
        <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="cartTitle">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="cartTitle">Cart</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue shop</button>
                        <a href="cart/view" class="btn btn-primary">Make order</a>
                        <button type="button" class="btn btn-danger" onclick="clearCart();">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="js-preloader" class="preloader">
            <img src="images/ring.svg" alt="Preloader">
        </div>

        <script>
        var site_url = '<?= SITE_URL; ?>';
        </script>
        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="js/typeahead.bundle.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
        </script>
        <script src="js/validator.js"></script>
        <script src="js/jquery.easydropdown.js"></script>
        <!--Slider-Starts-Here-->
        <script src="js/responsiveslides.min.js"></script>
        <script>
        // You can also use "$(window).load(function() {"
        $(function() {
            // Slideshow 4
            $("#slider4").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 500,
                namespace: "callbacks",
                before: function() {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function() {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
        </script>
        <!--End-slider-script-->
        <script src="megamenu/js/megamenu.js"></script>
        <!--dropdown-->
        <script src="js/jquery.easydropdown.js"></script>
        <script type="text/javascript">
        $(function() {

            var menu_ul = $('.menu_drop > li > ul'),
                menu_a = $('.menu_drop > li > a');

            menu_ul.hide();

            menu_a.click(function(e) {
                e.preventDefault();
                if (!$(this).hasClass('active')) {
                    menu_a.removeClass('active');
                    menu_ul.filter(':visible').slideUp('normal');
                    $(this).addClass('active').next().stop(true, true).slideDown('normal');
                } else {
                    $(this).removeClass('active');
                    $(this).next().stop(true, true).slideUp('normal');
                }
            });

        });
        </script>
        <!-- FlexSlider -->
        <script src="js/imagezoom.js"></script>
        <script defer src="js/jquery.flexslider.js"></script>

        <script>
        // Can also be used with $(document).ready()
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });
        </script>
        <script src="js/main.js"></script>

        <?php
    $logs = R::getDatabaseAdapter()
        ->getDatabase()
        ->getLogger();

    dump($logs->grep('SELECT'));
    ?>
    </body>

</html>