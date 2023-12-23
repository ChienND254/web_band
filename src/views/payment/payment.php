<?php
print_r($data)
?>
<form method="post" action="<?=_WEB_ROOT?>/payment/payment">
    <input type="hidden" name="order_id" value="<?=$data['order'][0]['id']?>">
    <input type="hidden" name="order_price" value="<?=$data['order'][0]['total_price']?>">
    <button type="submit" name="redirect" class="btn btn-primary" style="background-color: #0D6efd;">Thanh toán</button>

</form>