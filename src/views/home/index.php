<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Band</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div id="main">
        <div id="header">
            <!-- begin nav -->
            <ul id="nav">
                <li><a href="#">Home</a></li>
                <li><a href="#band">Band</a></li>
                <li><a href="#tour">Tour</a></li>
                <li><a href="#contact">Contact</a></li>
                <li>
                    <a href="#">
                        More
                        <i class="nav-icon ti-angle-down"></i>
                    </a>
                    <ul class="subnav">
                        <li><a href="#">Merchandise</a></li>
                        <li><a href="#">Extras</a></li>
                        <li><a href="#">Media</a></li>
                    </ul>
                </li>
            </ul>
            <!-- end nav -->

            <!-- mobile button -->
            <div id="mobile-menu" class="mobile-menu-btn">
                <i class="menu-icon ti-menu"></i>
            </div>

            <!-- search button -->

            <a class="search-btn" href="<?php echo _WEB_ROOT; ?>/cart">
                <i class="fa-solid fa-cart-shopping search-icon" style="color:#fff"></i>
            </a>
            <a class="search-btn" href="<?php echo _WEB_ROOT; ?>/user">
                <i class="fa-solid fa-user search-icon" style="color:#fff"></i>
            </a>
            <a class="search-btn" href="<?php echo _WEB_ROOT; ?>/tour/list" style="text-decoration: none;">
                <div class="search-icon ti-search"></div>
            </a>

        </div>
    </div>

    <div id="slider">
        <div class="text-content">
            <h2 class="text-heading">Chicago</h2>
            <div class="text-description">Thank you, Chicago - A night we won't forget.</div>
        </div>
    </div>

    <div id="content">
        <!-- about-section -->
        <div id="band" class="content-section">
            <h2 class="header-section">THE BAND</h2>
            <div class="content-sub-section">We love music</div>
            <p class="about-text">We have created a fictional band website. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

            <div class="member-list">
                <div class="member-item">
                    <p class="member-name">Name</p>
                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/img/content/bandmember.jpg" alt="name" class="member-img">
                </div>
                <div class="member-item">
                    <p class="member-name">Name</p>
                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/img/content/bandmember.jpg" alt="name" class="member-img">
                </div>
                <div class="member-item">
                    <p class="member-name">Name</p>
                    <img src="<?php echo _WEB_ROOT; ?>/public/assets/img/content/bandmember.jpg" alt="name" class="member-img">
                </div>
            </div>
        </div>

        <!-- Tour-section -->
        <div id="tour" class="tour-section">
            <div class="content-section">
                <h2 class="header-section text-whith">TOUR DATES</h2>
                <div class="content-sub-section text-whith">Remember to book your tickets!</div>

                <!-- tickets-list -->
                <ul class="tickets-list">
                    <li>New York <span class="sold-out">Sold Out</span></li>
                    <li>Paris <span class="sold-out">Sold Out</span></li>
                    <li>San Francisco <span class="quatily text-whith">3</span></li>
                </ul>

                <!-- place -->
                <div class="place-list">
                    <?php for ($i = 0; $i < 3; $i++) { ?>
                        <div class="place-item">
                            <img src="<?php echo _WEB_ROOT . "/tour/readfile/" . $tour_list[$i]['image'] ?>" alt="San Francisco" class="place-img">
                            <div class="place-body">
                                <h3 class="place-heading"><?php echo $tour_list[$i]['address'] ?></h3>
                                <p class="place-time"><?php echo $tour_list[$i]['date'] ?></p>
                                <p class="place-decs" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; "><?php echo $tour_list[$i]['description'] ?></p>
                                <a href="<?php echo _WEB_ROOT . "/tour/detail/" . $tour_list[$i]['id'] ?>" class="place-buy-btn js-buy-ticket s-full-width ">Buy Tickets</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div style="display: flex; justify-content: end; margin-top:10px">
                    <a href="<?php echo _WEB_ROOT . "/tour/list" ?>" style="color: #fff;">Show more</a>
                </div>
            </div>
        </div>

        <!-- contact-section -->
        <div id="contact" class="content-section">
            <h2 class="header-section">CONTACT</h2>
            <div class="content-sub-section">Fan? Drop a note!</div>

            <div class="row contact-content">
                <div class="col col-half s-col-full contact-info">
                    <p><i class="ti-location-pin"></i>Chicago, US</p>
                    <p><i class="ti-mobile"></i>Phone: <a href="tel:+00 151515">0837021702</a></p>
                    <p><i class="ti-email"></i>Email: <a href="mailto:mail@mail.com">nguyenbavietanh2002@mail.com</a></p>
                </div>
                <div class="col col-half s-col-full contact-form">
                    <form action="<?php echo _WEB_ROOT; ?>/home/send_mail" method="post">
                        <div class="row">
                            <div class="col col-half s-col-full">
                                <input type="text" placeholder="Name" required name="name" id="" class="from-control">
                            </div>

                            <div class="col col-half s-col-full s-mt-8">
                                <input type="text" placeholder="Email" required name="email" id="" class="from-control">
                            </div>
                        </div>
                        <div class="row mt-8">
                            <div class="col col-full">
                                <input type="text" placeholder="Message" required name="message" id="" class="from-control">
                            </div>
                        </div>
                        <button class="form-submit-btn mt-16 s-full-width" type="submit" value="SEND">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="map-section">
        <img src="<?php echo _WEB_ROOT; ?>/public/assets/img/footer/map.jpg" alt="map">
    </div>
    <div id="footer">
        <div class="socials-list">
            <a href=""><i class="ti-facebook"></i></a>
            <a href=""><i class="ti-instagram"></i></a>
            <a href=""><i class="ti-youtube"></i></a>
            <a href=""><i class="ti-pinterest"></i></a>
            <a href=""><i class="ti-twitter"></i></a>
            <a href=""><i class="ti-linkedin"></i></a>
        </div>
    </div>
    </div>

    <div class="modal">
        <div class="modal-container">
            <!-- header -->
            <header class="modal-header">
                <i class="modal-header-icon ti-bag"></i>
                Tickets
            </header>
            <div class="modal-close">
                <i class="ti-close"></i>
            </div>
            <!-- body -->
            <div class="modal-body">
                <label for="" class="modal-label">
                    <i class="ti-shopping-cart"></i>
                    Tickets, $15 per person
                </label>
                <input type="text" class="modal-input" placeholder="How many">

                <label for="" class="modal-label">
                    <i class="ti-user"></i>
                    Send To
                </label>
                <input type="email" class="modal-input" placeholder="Enter email...">

                <button class="modal-pay">
                    Pay <i class="ti-check"></i>
                </button>
            </div>
            <!-- footer -->
            <footer class="modal-footer">
                <p class="modal-held">Need <a href="">held?</a></p>
            </footer>
        </div>
    </div>

    <script>
    </script>

    <script>
        var header = document.getElementById('header');
        var mobileMenu = document.getElementById('mobile-menu');
        var headerHight = header.clientHeight;

        // Đóng/mở menu
        mobileMenu.onclick = function() {
            var isclose = header.clientHeight === headerHight;

            if (isclose) {
                header.style.height = 'auto';
            } else {
                header.style.height = null;
            }
        }

        // tự động đóng khi chon menu
        var menuItems = document.querySelectorAll('#nav li a[href*="#"]');
        for (var i = 0; i < menuItems.length; i++) {
            var menuItem = menuItems[i];

            menuItem.onclick = function(event) {
                var isparentMenu = this.nextElementSibling && this.nextElementSibling.classList.contains('subnav');
                if (!isparentMenu) {
                    header.style.height = null;
                } else {
                    event.preventDefault();
                }
            }
        }
    </script>
</body>

</html>