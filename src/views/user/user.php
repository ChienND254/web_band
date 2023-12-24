<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/src/views/user/style.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/src/views/user/responsive.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div id="main">
        <div id="header">
            <!-- begin nav -->
            <ul id="nav">
                <li><a href="<?php echo _WEB_ROOT; ?>/home">Home</a></li>

            </ul>
            <!-- end nav -->
            <!-- mobile button -->
            <div id="mobile-menu" class="mobile-menu-btn">
                <i class="menu-icon ti-menu"></i>
            </div>

            <!-- search button -->
        </div>
    </div>

    <div class="container-fluid d-flex" style="height: 100vh; padding: 0">
        <div class="col-md-3 menu-container">
            <div class="user-info d-flex flex-wrap justify-content-center">
                <img class="avatar-img" src="<?php echo _WEB_ROOT; ?>/user/readfile/<?php echo $user_context['image'] ?>" alt="">
                <div style="width: 100%; text-align: center;">Hello <?php echo $user_context['name'] ?></div>
            </div>
            <div class="menu-list">
                <div id="info" class="menu-item menu-item-active" onclick="changeContent(1)">
                    <i class="fa-solid fa-user"></i>
                    <span>USER</span>
                </div>
                <div id="order" class="menu-item" onclick="changeContent(2)">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>ORDER</span>
                </div>
                <div id="ticket" class="menu-item" onclick="changeContent(3)">
                    <i class="fa-solid fa-ticket"></i>
                    <span>TICKET</span>
                </div>
                <form class="menu-item" action="<?php echo _WEB_ROOT; ?>/user/logout" method="post">
                    <button type="submit" name="runLink">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>LOGOUT</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="col-md-9 col-12 content-container" id="content-container">
            <div id="info-content">
                <h2>USER INFOMATION</h2>
                <form method="post" action="<?php echo _WEB_ROOT; ?>/user/update">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 user-form-item">
                            <span>Email:</span>
                            <input type="email" name="email" value="<?php echo $user_context['email'] ?>">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="user-form-item col-md-6">
                            <span>Username:</span>
                            <input type="text" name="name" value="<?php echo $user_context['name'] ?>">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="user-form-item col-md-6">
                            <span>Phone:</span>
                            <input type="number" min="0" name="phone" value="<?php echo $user_context['phone'] ?>">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="user-form-item col-md-6">
                            <span>Address:</span>
                            <input type="text" name="address" value="<?php echo $user_context['address'] ?>">
                        </div>
                        <div class="row d-flex justify-content-center">
                        </div>
                        <div class="user-form-item col-md-6 d-flex justify-content-end">
                            <button class="btn" type="submit" style="background-color: #000; color: #fff;">Save</button>
                        </div>
                    </div>
                </form>
                <form class="p-3" action="<?php echo _WEB_ROOT . "/change/index/" . $user_context['reset_token'] ?>" method="post">
                    <div class="row d-flex justify-content-center">
                        <div class="user-form-item col-md-6 d-flex justify-content-start">
                            <button class="btn" type="submit" style="background-color: #000; color: #fff;">Change password</button>
                        </div>
                    </div>
                </form>
                <form class="p-3" action="<?php echo _WEB_ROOT ?>/user/change_avatar" method="post" enctype="multipart/form-data">
                    <div class="row d-flex justify-content-center">
                        <div class="user-form-item col-md-6 d-flex justify-content-start">
                            Select image to upload:
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class=" col-md-6 d-flex justify-content-start">
                            <input class="btn" type="submit" style="background-color: #000; color: #fff;" value="Upload Image" name="submit">
                        </div>
                    </div>

                </form>
            </div>
            <div id="order-content">
                <h2>MY ORDER</h2>
                <div style="height: 100%; overflow-y: scroll;">
                    <table class="mt-3" border="1" style="width: 100%; text-align: center;">
                        <tr style=" background-color: #000; color:#fff">
                            <!-- Thẻ <th> đại diện cho đầu cột hoặc đầu hàng -->
                            <th class="col-md-2">Order ID</th>
                            <th class="col-md-3">Order date</th>
                            <th class="col-md-3">Address</th>
                            <th class="col-md-2">Price</th>
                            <th class="col-md-2"></th>
                        </tr>
                        <?php foreach ($order as $order_item) { ?>
                            <tr>
                                <td><?php echo $order_item['id']; ?></td>
                                <td><?php echo $order_item['order_date']; ?></td>
                                <td><?php echo $order_item['address']; ?></td>
                                <td><?php echo $order_item['total_price']; ?>$</td>
                                <td><button class="btn btn-primary" onclick="showModal()">View</button></td>
                                <div id="modal-content">
                                    <div class="d-flex justify-content-center">
                                        <div style="width: 700px; height: 500px; background-color: #fff; margin-top: 100px; overflow-y: scroll; text-align: center;">
                                            <div class="d-flex justify-content-end align-items-center" style="width: 100%; height: 50px; background-color: #000; color:#fff; font-size: 30px;">
                                                <button style="width: 50px; height: 50px;" onclick="closeModal()">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <div class=p-3>
                                                <div class="d-flex" style="border: 1px solid #000; background-color: #000; color: #fff;">
                                                    <div class=col-md-4>Ticket ID</div>
                                                    <div class=col-md-4>Tour ID</div>
                                                    <div class=col-md-4>Price</div>
                                                </div>
                                                <?php foreach ($order_item['order_line'] as $ticket) { ?>
                                                    <div class="d-flex" style="border: 1px solid #000;">
                                                        <div class=col-md-4><?php echo $ticket['id'] ?></div>
                                                        <div class=col-md-4><?php echo $ticket['tour_id'] ?></div>
                                                        <div class=col-md-4><?php echo $ticket['price'] ?></div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div id="ticket-content">
                <h2>MY TICKET</h2>
                
                <div style="height: 100%; overflow-y: scroll;">
                    <table class="mt-3" border="1" style="width: 100%; text-align: center;">
                        <tr style=" background-color: #000; color:#fff">
                            <!-- Thẻ <th> đại diện cho đầu cột hoặc đầu hàng -->
                            <th class="col-md-1">Tour</th>
                            <th class="col-md-3"></th>
                            <th class="col-md-2">Ticket ID</th>
                            <th class="col-md-2">Order ID</th>
                            <th class="col-md-2">Price</th>
                            <th class="col-md-2"></th>
                        </tr>
                        <?php foreach ($order as $order_item) {
                            foreach ($order_item['order_line'] as $ticket) { ?>
                                <tr>
                                    <td><img style="width: 100px; height: 100px;padding: 10px;" src="<?php echo _WEB_ROOT; ?>/tour/readfile/<?php echo $ticket['tour_id']['image'] ?>" alt=""></td>
                                    <!-- <td><?php echo _WEB_ROOT; ?>/user/readfile/<?php echo $ticket['tour_id']['image'] ?></td> -->
                                    <td><?php echo $ticket['tour_id']['address'] ?></td>
                                    <td><?php echo $ticket['id'] ?></td>
                                    <td><?php print_r($order_item['id'])  ?></td>
                                    <td><?php echo $ticket['price'] ?>$</td>
                                    <td><a href="<?php echo _WEB_ROOT . "/tour/detail/" . $ticket['tour_id']['id'] ?>" class="btn btn-primary">View</a></td>
                                </tr>
                        <?php }
                        } ?>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        function changeContent(idContent) {
            var content = document.getElementById("content-container")
            var info = document.getElementById("info");
            var order = document.getElementById("order");
            var ticket = document.getElementById("ticket")
            var infoContent = document.getElementById("info-content");
            var orderContent = document.getElementById("order-content");
            var ticketContent = document.getElementById("ticket-content");
            if (idContent == 1) {
                infoContent.style.display = "block"
                orderContent.style.display = "none"
                ticketContent.style.display = "none"
                info.classList.add('menu-item-active');
                order.classList.remove('menu-item-active');
                ticket.classList.remove('menu-item-active');
            } else if (idContent == 2) {
                infoContent.style.display = "none"
                ticketContent.style.display = "none"
                orderContent.style.display = "block"
                info.classList.remove('menu-item-active');
                ticket.classList.remove('menu-item-active');
                order.classList.add('menu-item-active');
            } else if (idContent == 3) {
                infoContent.style.display = "none"
                ticketContent.style.display = "block"
                orderContent.style.display = "none"
                info.classList.remove('menu-item-active');
                order.classList.remove('menu-item-active');
                ticket.classList.add('menu-item-active');
            }
        }

        function showModal() {
            var modal = document.getElementById("modal-content");
            modal.style.display = "block"
        }

        function closeModal() {
            var modal = document.getElementById("modal-content");
            modal.style.display = "none";
        }
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>