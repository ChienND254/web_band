<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= _WEB_ROOT ?>/public/assets/css/admin.css">
    <link rel="stylesheet" type="text/css" href="<?= _WEB_ROOT ?>/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= _WEB_ROOT ?>/public/assets/css/dataTables.bootstrap4.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= _WEB_ROOT ?>/public/assets/css/datepicker.css"> -->

    <script type="text/javascript" src="<?= _WEB_ROOT ?>/public/assets/js/admin.js"></script>
    <script type="text/javascript" src="<?= _WEB_ROOT ?>/public/assets/js/user.js"></script>
    
    
    <script type="text/javascript" src="<?= _WEB_ROOT ?>/public/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= _WEB_ROOT ?>/public/assets/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= _WEB_ROOT ?>/public/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= _WEB_ROOT ?>/public/assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= _WEB_ROOT ?>/public/assets/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/4afa83a413.js"></script>

    <title>Trang quản lý</title>
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=_WEB_ROOT?>/home">WEB_BAND</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= _WEB_ROOT ?>/admin">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= _WEB_ROOT ?>/userManage">Quản lý người dùng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= _WEB_ROOT ?>/tourManage">Quản lý tour diễn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= _WEB_ROOT ?>/ticketManage">Quản lý vé</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= _WEB_ROOT ?>/orderManage">Quản lý đơn hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= _WEB_ROOT ?>/user/logout">ChangePassword</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= _WEB_ROOT ?>/user/logout">LogOut</a>
                    </li>
                </ul>
            </div>
            <div class="form-inline my-2 my-lg-0" style="font-weight:bold;font-size:larger" id="timer">0:05:09</div>
        </div>
    </nav>