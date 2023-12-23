<?php
class Payment extends Controller
{
    public $data = [];
    public $file;
    public $model_order;
    public function __construct()
    {
        $this->model_order = $this->model('OrderModel');
    }

    public function index()
    {
        $data['order'] = $this->model_order->getLastModel();
        $this->render("payment/payment", $data);
    }
    public function payment()
    {
        $payment = new payment_vnpay();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $order_id = $_POST['order_id'];
            $order_price = $_POST['order_price'];
            $payment->vnpay_payment($order_id, $order_price);
        }
    }
    public function success($order_id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $data = array(
                    'status' => 1,
                );
                $this->model_order->updateModel($order_id,$data);
                $this->render('payment/success_payment');
            } else {
                $this->render('payment/fail_payment');
            }
            exit();
        }
    }
}
