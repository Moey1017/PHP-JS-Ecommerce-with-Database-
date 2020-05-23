<?php
session_start();
$order_total = $_SESSION["order_total"];
$user_id = $_SESSION["user_id"];
if (isset($_SESSION["user_name"])) {
    $user_name = "Hello " . $_SESSION["user_name"];
} else {
    $user_name = "";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cart</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Sublime project">
        <link rel="shortcut icon" href="images/plug_favIcon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
        <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="styles/cart.css">
        <link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">let total_order = '<?php echo $order_total; ?>';</script>
        <script src="script/get_order_total.js" type="text/javascript"></script>
        <script src="script/get_cart.js" type="text/javascript"></script>
        <script src="script/check_order.js" type="text/javascript"></script>
    </head>
    <body onload='ajaxGetCartItems()'>

        <div class="super_container">

            <!-- Header -->

            <header class="header">
                <div class="header_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="header_content d-flex flex-row align-items-center justify-content-start">
                                    <div class="logo"><a href="#"><i class="fa fa-plug"></i>Glich</a></div>
                                    <nav class="main_nav">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <li>
                                                <a href="categories.php?page_number=1">Shop by</a>
                                            </li>
                                            <li><a href="contact.php">Contact</a></li>
                                            <?php
                                            if (isset($user_id)) {
                                                echo "<li><a href='php/logout_transaction.php'>Logout</a><li>";
                                            } else {
                                                echo "<li><a href = 'login.php'>Login</a></li>";
                                            }
                                            ?>
                                            <li><?php echo $user_name ?></li>
                                        </ul>
                                    </nav>
                                    <div class="header_extra ml-auto">
                                        <div class="shopping_cart">
                                            <a href="cart.php">
                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     viewBox="0 0 489 489" style="enable-background:new 0 0 489 489;" xml:space="preserve">
                                                <g>
                                                <path d="M440.1,422.7l-28-315.3c-0.6-7-6.5-12.3-13.4-12.3h-57.6C340.3,42.5,297.3,0,244.5,0s-95.8,42.5-96.6,95.1H90.3
                                                      c-7,0-12.8,5.3-13.4,12.3l-28,315.3c0,0.4-0.1,0.8-0.1,1.2c0,35.9,32.9,65.1,73.4,65.1h244.6c40.5,0,73.4-29.2,73.4-65.1
                                                      C440.2,423.5,440.2,423.1,440.1,422.7z M244.5,27c37.9,0,68.8,30.4,69.6,68.1H174.9C175.7,57.4,206.6,27,244.5,27z M366.8,462
                                                      H122.2c-25.4,0-46-16.8-46.4-37.5l26.8-302.3h45.2v41c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h139.3v41
                                                      c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h45.2l26.9,302.3C412.8,445.2,392.1,462,366.8,462z"/>
                                                </g>
                                                </svg>
                                                <div>Cart <span></span></div>
                                            </a>
                                        </div>
                                        <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Panel -->
                <div class="search_panel trans_300">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="search_panel_content d-flex flex-row align-items-center justify-content-end">
                                    <form action="#">
                                        <input type="text" class="search_input" placeholder="Search" required="required">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social -->
                <div class="header_social">
                    <ul>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </header>

            <!-- Menu -->

            <div class="menu menu_mm trans_300">
                <div class="menu_container menu_mm">
                    <div class="page_menu_content">

                        <div class="page_menu_search menu_mm">
                            <form action="#">
                                <input type="search" required="required" class="page_menu_search_input menu_mm" placeholder="Search for products...">
                            </form>
                        </div>
                        <ul class="page_menu_nav menu_mm">
                            <li class="page_menu_item menu_mm">
                                <a href="index.php">Home</a>
                            </li>
                            <li class="page_menu_item menu_mm">
                                <a href="categories.php?page_number=1">Shop</a>
                            </li>
                            <li class="page_menu_item menu_mm"><a href="contact.php">Contact</a></li>
                            <li class="page_menu_item menu_mm"><a href="login.php">Login</a></li>
                        </ul>
                    </div>
                </div>

                <div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>

                <div class="menu_social">
                    <ul>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>

            <!-- Home -->

            <div class="home">
                <div class="home_container">
                    <div class="home_background" style="background-image:url(images/cart.jpg)"></div>
                    <div class="home_content_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content">
                                        <div class="breadcrumbs">
                                            <ul>
                                                <li><a href="index.html">Home</a></li>
                                                <li><a href="categories.html?page_number=1">Categories</a></li>
                                                <li>Shopping Cart</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Info -->

            <div class="cart_info">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <!-- Column Titles -->
                            <div class="cart_info_columns clearfix">
                                <div class="cart_info_col cart_info_col_product">Product</div>
                                <div class="cart_info_col cart_info_col_price">Price</div>
                                <div class="cart_info_col cart_info_col_quantity">Quantity</div>
                                <div class="cart_info_col cart_info_col_total">Total</div>
                            </div>
                        </div>
                    </div>
                    <div class="row cart_items_row">
                        <div class="col">
                            <div id="cart">

                            </div>
                        </div>
                    </div>
                    <div class="row row_cart_buttons">
                        <div class="col">
                            <div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
                                <div class="button continue_shopping_button"><a href="categories.php?page_number=1">Continue shopping</a></div>
                                <div class="cart_buttons_right ml-lg-auto">
                                    <div class="button update_cart_button"><a href="cart.php">Update cart</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row_extra">
                        <div class="col-lg-4">

                            <!-- Delivery -->
                            <div class="delivery">
                                <div class="section_title">Shipping method</div>
                                <div class="section_subtitle">Select the one you want</div>
                                <div class="delivery_options">
                                    <label class="delivery_option clearfix">Next day delivery
                                        <input type="radio" name="shipping" id="next_day_radio" value="4.99" onclick="getShippingPrice(4.99)">
                                        <span class="checkmark"></span>
                                        <span class="delivery_price"><span id="next_day_price" value="4.99">€4.99</span></span>
                                    </label>
                                    <label class="delivery_option clearfix">Standard delivery
                                        <input type="radio" name="shipping" id="standard_delivery_radio" value="1.99" onclick="getShippingPrice(1.99)">
                                        <span class="checkmark"></span>
                                        <span class="delivery_price"><span id="standard_price" value="1.99">€1.99</span></span>
                                    </label>
                                    <label class="delivery_option clearfix">Personal pickup
                                        <input type="radio" checked="checked" name="shipping" id="free_radio1"  value="0" onclick="getShippingPrice('Free')">
                                        <span class="checkmark"></span>
                                        <span class="delivery_price"><span id="free_price" value="0">Free</span></span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 offset-lg-2">
                            <div class="cart_total">
                                <div class="section_title">Cart total</div>
                                <div class="section_subtitle">Final info</div>
                                <div class="cart_total_container">
                                    <ul>
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="cart_total_title">Subtotal</div>
                                            <div class="cart_total_value ml-auto"><div id="subtotal"></div></div>
                                        </li>
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="cart_total_title">Shipping</div>
                                            <div class="cart_total_value ml-auto"><div id="shipping_price"></div></div>
                                        </li>
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="cart_total_title">Total</div>
                                            <div class="cart_total_value ml-auto"><span>€</span><span id="total"></span></div>

                                        </li>
                                    </ul>
                                </div>
                                <div class="button checkout_button"><a onclick="ajaxCheckOrder()">Proceed to checkout</a></div>
                            </div>
                        </div>
                    </div>
                </div>		
            </div>

            <!-- Footer -->

            <div class="footer_overlay"></div>
            <footer class="footer">
                <div class="footer_background" style="background-image:url(images/footer.jpg)"></div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="footer_content d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                                <div class="footer_logo"><a href="#"><i class="fa fa-plug"></i>Glich</a></div>
                                <div class="copyright ml-auto mr-auto"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> William Hadnett | BootStrap Template Provided by: <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
                                <div class="footer_social ml-lg-auto">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="styles/bootstrap4/popper.js"></script>
        <script src="styles/bootstrap4/bootstrap.min.js"></script>
        <script src="plugins/greensock/TweenMax.min.js"></script>
        <script src="plugins/greensock/TimelineMax.min.js"></script>
        <script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
        <script src="plugins/greensock/animation.gsap.min.js"></script>
        <script src="plugins/greensock/ScrollToPlugin.min.js"></script>
        <script src="plugins/easing/easing.js"></script>
        <script src="plugins/parallax-js-master/parallax.min.js"></script>
        <script src="js/cart.js"></script>
    </body>
</html>