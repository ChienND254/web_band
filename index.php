<?php
session_start();
if (!isset($_COOKIE['cart'])) {
    setcookie("cart", json_encode([]), time() + (86400 * 30), "/"); // 86400 = 1 day
}
require_once 'bootstrap.php';
$app = new App();
?>