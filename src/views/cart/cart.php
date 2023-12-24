<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/src/views/cart/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="cart-icon">
    </div>
    <div>
        <div id="wrapper">
            <div id="header">
                <ul id="nav">
                    <li><a href="<?php echo _WEB_ROOT; ?>/home">Home</a></li>
                </ul>
            </div>
        </div>
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
                                    <p><span><?php echo $cart['quantity'] * $cart['tour_id']['price'] ?>$</span></p>
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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
                                <button type="submit" class="btn btn-primary" style="background-color: #0D6efd;">Save changes</button>
                            </div>
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
    <script src="<?php echo _WEB_ROOT; ?>/src/views/cart/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>