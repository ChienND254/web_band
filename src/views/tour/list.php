<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Danh Sách Vé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            /* justify-content: space-around; */
            max-width: 1200px;
            margin: 20px auto;
        }

        .card {
            box-sizing: border-box;
            width: calc(33.33% - 20px);
            margin: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card .content {
            padding: 10px;
        }

        h3,
        p {
            margin: 0;
            color: #333;
        }

        .buy-ticket {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            width: 100%;
            cursor: pointer;
        }

        .buy-ticket:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div id="main">
        <div id="header">
            <!-- begin nav -->
            <ul id="nav">
                <li><a href="<?php echo _WEB_ROOT; ?>/home">Home</a></li>
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
    <div class="container mt-5">

        <?php foreach ($tour_list as $tour) { ?>
            <div class="card">
                <img src="<?php echo _WEB_ROOT . "/tour/readfile/" . $tour['image'] ?>" alt="San Francisco" class="place-img">
                <div class="content">
                    <h3 class="place-heading"><?php echo $tour['address'] ?></h3>
                    <p class="place-time"><?php echo $tour['date'] ?></p>
                    <p class="place-decs"><?php echo $tour['description'] ?></p>
                    <!-- <form action="<?php echo _WEB_ROOT . "/tour/detail/$tour[id]" ?>" <button class="buy-ticket">Buy Tickets</button> </form> -->

                    <a href="<?php echo _WEB_ROOT . "/tour/detail/$tour[id]" ?>" style="color: #fff;text-decoration: none;">
                        <div class="buy-ticket" style="width: 94%;">
                            Buy Tickets
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>