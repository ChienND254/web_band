<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- <script src="https://kit. fontawesome.com/54f0cb7e4a.js" .crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/src/views/cart/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="cart-icon">
        <!-- <p><i class="fa-solid fa-cart-shopping"></i><span>390.000</span><sup>đ</sup></p> -->
    </div>
    <div>
        <div id="wrapper">
            <div id="header">
                <ul id="nav">
                    <li><a href="<?php echo _WEB_ROOT; ?>/home">Home</a></li>
                    <!-- <li><a href="">Band</a></li>
                <li><a href="">Tour</a></li>
                <li><a href="">Contact</a></li>
                <li>
                    <a href="#">More</a>
                </li> -->
                </ul>
            </div>
        </div>
        <!-- <section class="product">
        <div class="container">
            <div class="product-items">
                <div class="product-item">
                    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/400976223_687089660204675_3624503934333500228_n.png?stp=dst-png_p206x206&_nc_cat=109&ccb=1-7&_nc_sid=510075&_nc_ohc=mYfUEJpdOzoAX8Q7pPP&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AdRSAycHZcG1AGMvEiEPwAJKUFxBSMoethocIWlf8bysTA&oe=65A75496" alt="">
                    <div class="product-item-text">
                        <p><span>25</span>$</p>
                        <h1 style="front-weight: bold; font-size: 18px;">Paris</h1>
                    </div>
                    <button>Buy</button>
                </div>
                <div class="product-item">
                    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/385557039_858693336038849_3209243677570663189_n.png?stp=dst-png_p206x206&_nc_cat=100&ccb=1-7&_nc_sid=510075&_nc_ohc=uAc-hpIhV6cAX8EABwe&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AdTiPrXDNiya5jCV9nvucrp-KtCCD-TW-ysCAfLjTCHq2g&oe=65A7617B" alt="">
                    <div class="product-item-text">
                        <p><span>25</span>$</p>
                        <h1 style="front-weight: bold; font-size: 18px;">Washington, D.C</h1>
                    </div>
                    <button>Buy</button>
                </div>
                <div class="product-item">
                    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/410377162_1429831814285474_393651852596417383_n.png?stp=dst-png_p75x225&_nc_cat=101&ccb=1-7&_nc_sid=510075&_nc_ohc=DSjHdlz3YL4AX-TYN76&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AdQAV_UeIJEitcx9eliOuzkNqG7pBFOLkyyQiqNtTKFcGQ&oe=65A75849" alt="">
                    <div class="product-item-text">
                        <p><span>25</span>$</p>
                        <h1 style="front-weight: bold; font-size: 18px;">Ha Noi</h1>
                    </div>
                    <button>Buy</button>
                </div>
                <div class="product-item">
                    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/385404491_713034426823264_2745194809182293040_n.png?stp=dst-png_s206x206&_nc_cat=105&ccb=1-7&_nc_sid=510075&_nc_ohc=IEZvDtmBMgIAX9PQuyw&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AdTJWuviKNnjCn_Gyj9tz2PkMhVYfteoaJxZmryOPU2PVg&oe=65A75602" alt="">
                    <div class="product-item-text">
                        <p><span>25</span>$</p>
                        <h1 style="front-weight: bold; font-size: 18px;">Tokyo</h1>
                    </div>
                    <button>Buy</button>
                </div>
                <div class="product-item">
                    <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/385544988_390685079977467_5383288911234620663_n.png?stp=dst-png_p206x206&_nc_cat=102&ccb=1-7&_nc_sid=510075&_nc_ohc=7MQ5e1ojpg8AX-9oO1E&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AdRuyJ2jktx8IkEuHiEcOBPRo86z3aDp4vYJtUZbSQzOzA&oe=65A7642B" alt="">
                    <div class="product-item-text">
                        <p><span>25</span>$</p>
                        <h1 style="front-weight: bold; font-size: 18px;">London</h1>
                    </div>
                    <button>Buy</button>
                </div>
                
            </div>
        </div>
    </section> -->
        <section class="cart">
            <h2>Cart</h2>
            <form action="<?php echo _WEB_ROOT; ?>/cart/create" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Money</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_list as $cart) { ?>
                            <tr>
                                <td style="display: flex; align-items: left;">
                                    <img style="width:70px" src="<?php echo _WEB_ROOT ?>/cart/readfile/<?php echo $cart['tour_id']['image'] ?>" alt="">
                                    <div style="line-height: 70px; padding-left: 30px;"><?php echo $cart['tour_id']['address'] ?></div>
                                </td>
                                <td><input readonly style="width: 50px; outline: none;" type="number" value="<?php echo $cart['quantity'] ?>" min="1"></td>
                                <td>
                                    <p><span><?php echo $cart['quantity'] * $cart['tour_id']['price'] ?></span></p>
                                </td>
                                <td>
                                    <button type="button" onclick="removeCart(id)"> remove</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div style="text-align: right;" class="price-total">
                    <p style="font-weight: bold; margin-top: 20px"> Sum:<span>
                            <?php $sum = 0;
                            foreach ($cart_list as $cart) {
                                $sum += $cart['quantity'] * $cart['tour_id']['price'];
                            }
                            echo $sum;
                            ?>
                        </span>$</p>
                </div>
                <!-- Button trigger modal -->
                <button id='btn-order' type="button" class="btn btn-primary" style="background-color: #0D6efd;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Done
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận đơn hàng</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h3>Xác nhận đặt hàng</h3>
                                <div>Username: <?php echo $user_context['name'] ?></div>
                                <div>Address: <?php echo $user_context['address'] ?></div>
                                Total Price: <?php $sum = 0;
                                                foreach ($cart_list as $cart) {
                                                    $sum += $cart['quantity'] * $cart['tour_id']['price'];
                                                }
                                                echo $sum;
                                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" style="background-color: #000;" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id ="button_confirm" class="btn btn-primary" style="background-color: #0D6efd;">Xác nhận đơn hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
                </section>

    </div>
   

    <script>
        function removeCart(id) {
            let a = JSON.parse(getCookie("cart"));
            a.splice(id, 1);
            setCookie("cart", JSON.stringify(a), 1)
            console.log(getCookie('cart'));
            window.location.reload();
        }

        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
    </script>
    <script>
        const btnSendOrder = document.getElementById("btn-order");
        let a = JSON.parse(getCookie("cart"));
        if (a.length == 0) {
            btnSendOrder.style.display = "none";
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>