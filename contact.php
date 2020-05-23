<?php
session_start();
$user_id = $_SESSION["user_id"];
if(isset($_SESSION["user_name"]))
{
    $user_name = "Hello ".$_SESSION["user_name"];
}
else
{
    $user_name = "";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Contact</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Sublime project">
        <link rel="shortcut icon" href="images/plug_favIcon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
        <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="images/plug_favIcon.png">
        <link rel="stylesheet" type="text/css" href="styles/contact.css">
        <link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

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
                                            <li><a href="contact.html">Contact</a></li>
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
                    <div class="home_background" style="background-image:url(images/macbook_slider.jpg)"></div>
                    <div class="home_content_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content">
                                        <div class="breadcrumbs">
                                            <ul>
                                                <li><a href="index.html">Home</a></li>
                                                <li>Contact</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact -->

            <div class="contact">
                <div class="container">
                    <div class="row">

                        <!-- Get in touch -->
                        <div class="col-lg-8 contact_col">
                            <div class="get_in_touch">
                                <div class="section_title">Get in Touch</div>
                                <div class="section_subtitle">Say hello</div>
                                <div class="contact_form_container">
                                    <form action="#" id="contact_form" class="contact_form">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!-- Name -->
                                                <label for="contact_name">First Name*</label>
                                                <input type="text" id="contact_name" class="contact_input" required="required">
                                            </div>
                                            <div class="col-xl-6 last_name_col">
                                                <!-- Last Name -->
                                                <label for="contact_last_name">Last Name*</label>
                                                <input type="text" id="contact_last_name" class="contact_input" required="required">
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Subject -->
                                            <label for="contact_company">Subject</label>
                                            <input type="text" id="contact_company" class="contact_input">
                                        </div>
                                        <div>
                                            <label for="contact_textarea">Message*</label>
                                            <textarea id="contact_textarea" class="contact_input contact_textarea" required="required"></textarea>
                                        </div>
                                        <button class="button contact_button"><span>Send Message</span></button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="col-lg-3 offset-xl-1 contact_col">
                            <div class="contact_info">
                                <div class="contact_info_section">
                                    <div class="contact_info_title">Marketing</div>
                                    <ul>
                                        <li>Phone: <span>+353 1 437 0969</span></li>
                                        <li>Email: <span>marketing@glich.com</span></li>
                                    </ul>
                                </div>
                                <div class="contact_info_section">
                                    <div class="contact_info_title">Shipping & Returns</div>
                                    <ul>
                                        <li>Phone: <span>+353 1 437 0969</span></li>
                                        <li>Email: <span>returns@glich.com</span></li>
                                    </ul>
                                </div>
                                <div class="contact_info_section">
                                    <div class="contact_info_title">Information</div>
                                    <ul>
                                        <li>Phone: <span>+353 1 437 0969</span></li>
                                        <li>Email: <span>info@glich.com</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row map_row">
                        <div class="col">

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
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
        <script src="js/contact.js"></script>
    </body>
</html>