<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<center>
<form method="post" action="<?=_WEB_ROOT?>/payment/payment">
    <input type="hidden" name="order_id" value="<?=$data['order'][0]['id']?>">
    <input type="hidden" name="order_price" value="<?=$data['order'][0]['total_price']?>">
    <button type="submit" name="redirect" class="btn btn-primary" style="width: 500px;height: 500px;background-color: green;">Thanh toán</button>
</form>
</center>