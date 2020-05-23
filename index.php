<?php
session_start();
$user_id = $_SESSION["user_id"];
if (isset($_SESSION["user_name"])) {
    $user_name = "Hello " . $_SESSION["user_name"];
} else {
    $user_name = "";
}

if ($_SESSION["access_level"] == 1) {
    $admin = 1;
} else {
    $admin = '';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Glich</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Sublime project">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
        <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="images/plug_favIcon.png">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
        <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="styles/responsive.css">
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <script src="script/load_new_products.js" type="text/javascript"></script>

    </head>
    <body onload="ajaxNewProducts(<?php echo $admin ?>)">

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
                <div class="home_slider_container">

                    <!-- Home Slider -->
                    <div class="owl-carousel owl-theme home_slider">

                        <!-- Slider Item -->
                        <div class="owl-item home_slider_item">
                            <div class="home_slider_background" style="background-image:url(images/headphone_slider.jpg)"></div>
                            <div class="home_slider_content_container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
                                                <div class="home_slider_title">Step Into The Glich!</div>
                                                <div class="home_slider_subtitle">Here at Glich we offer a wide array of products, so step in and enjoy.</div>
                                                <div class="button button_light home_button"><a href="#">Shop Now</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slider Item -->
                        <div class="owl-item home_slider_item">
                            <div class="home_slider_background" style="background-image:url(images/macbook_slider.jpg)"></div>
                            <div class="home_slider_content_container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
                                                <div class="home_slider_title">Best - First Class!</div>
                                                <div class="home_slider_subtitle">Here at Glich we offer a wide variety of products, ranging from laptops to earphones. So we have something to suit everybody.</div>
                                                <div class="button button_light home_button"><a href="#">Shop Now</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slider Item -->
                        <div class="owl-item home_slider_item">
                            <div class="home_slider_background" style="background-image:url(images/phone_slider.jpg)"></div>
                            <div class="home_slider_content_container">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
                                                <div class="home_slider_title">The Care Effect!</div>
                                                <div class="home_slider_subtitle">We care about every single customer that purchases one of our products. So, if you are not happy with your purchase or the service you got please get in touch!</div>
                                                <div class="button button_light home_button"><a href="#">Shop Now</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Home Slider Dots -->

                    <div class="home_slider_dots_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_slider_dots">
                                        <ul id="home_slider_custom_dots" class="home_slider_custom_dots">
                                            <li class="home_slider_custom_dot active">01.</li>
                                            <li class="home_slider_custom_dot">02.</li>
                                            <li class="home_slider_custom_dot">03.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>	
                    </div>

                </div>
            </div>

            <!-- Ads -->

            <div class="avds">
                <div class="avds_container d-flex flex-lg-row flex-column align-items-start justify-content-between">
                    <div class="avds_small">
                        <div class="avds_background" style="background-image:url(images/smart_phone_ad.jpg)"></div>
                        <div class="avds_small_inner">
                            <div class="avds_discount_container">
                                <img src="images/discount.png" alt="">
                                <div>
                                    <div class="avds_discount">
                                        <div>20<span>%</span></div>
                                        <div>Discount</div>
                                    </div>
                                </div>
                            </div>
                            <div class="avds_small_content">
                                <div class="avds_title">Smart Phones</div>
                                <div class="avds_link"><a href="categories.html">See More</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="avds_large">
                        <div class="avds_background" style="background-image:url(images/comp_power_ad.jpg)"></div>
                        <div class="avds_large_container">
                            <div class="avds_large_content">
                                <div class="avds_title">Computing Power</div>
                                <div class="avds_text">Glich is for the Gamers, Casual Users and Professionals. So check out our range of laptops, your sure to find something you like.</div>
                                <div class="avds_link avds_link_large"><a href="categories.html">See More</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products -->

            <div class="products">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div id="product_grid"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ad -->

            <div class="avds_xl">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="avds_xl_container clearfix">
                                <div class="avds_xl_background" style="background-image:url(images/avds_xl.jpg)"></div>
                                <div class="avds_xl_content">
                                    <div class="avds_title">For The Techies</div>
                                    <div class="avds_text">Did someone say GADGETS. Check out our Accessories for all the latest Gadgets.</div>
                                    <div class="avds_link avds_xl_link"><a href="categories.html">See More</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Icon Boxes -->

            <div class="icon_boxes">
                <div class="container">
                    <div class="row icon_box_row">

                        <!-- Icon Box -->
                        <div class="col-lg-4 icon_box_col">
                            <div class="icon_box">
                                <div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
                                <div class="icon_box_title">Free Shipping Worldwide</div>
                                <div class="icon_box_text">
                                    <p>You will be glad to know that we ship Worldwide so everyone can enjoy.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Icon Box -->
                        <div class="col-lg-4 icon_box_col">
                            <div class="icon_box">
                                <div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
                                <div class="icon_box_title">Free Returns</div>
                                <div class="icon_box_text">
                                    <p>Return using the FREE Hermes ParcelShop service</p>
                                </div>
                            </div>
                        </div>

                        <!-- Icon Box -->
                        <div class="col-lg-4 icon_box_col">
                            <div class="icon_box">
                                <div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
                                <div class="icon_box_title">24h Fast Support</div>
                                <div class="icon_box_text">
                                    <p>We Care! So if you experience a problem get in touch via our Contact page.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Newsletter -->

            <div class="newsletter">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="newsletter_border"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="newsletter_content text-center">
                                <div class="newsletter_title">Subscribe to our newsletter</div>
                                <div class="newsletter_text"><p>We won't spam you, but we will keep you updated!</p></div>
                                <div class="newsletter_form_container">
                                    <form action="#" id="newsletter_form" class="newsletter_form">
                                        <input type="email" class="newsletter_input" required="required">
                                        <button class="newsletter_button trans_200"><span>Subscribe</span></button>
                                    </form>
                                </div>
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
        <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
        <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
        <script src="plugins/easing/easing.js"></script>
        <script src="plugins/parallax-js-master/parallax.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>
