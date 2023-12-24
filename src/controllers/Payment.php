<?php
class Payment extends Controller
{
    public $data = [];
    public $file;
    public $model_order;
    public $model_ticket;
    public $model_order_line;
    public function __construct()
    {
        $this->model_order = $this->model('OrderModel');
        $this->model_ticket = $this->model('TicketModel');
        $this->model_order_line = $this->model('OrderLineModel');
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
                $data_ticket = [
                    'status' => "OUT_OF_STOCK",
                ];
                $this->model_order->updateModel($order_id,$data);
                $order = $this->model_order->getLastModel();
                foreach ($order as $row) {
                    $result = $this->model_order_line->getListModel("WHERE order_id=".$row["id"]);
                }
                foreach ($result as $row) {
                    $this->model_ticket->updateModel($row['ticket_id'],$data_ticket);
                }
                $mail = new MailSender();
                $mail->sendMail($_SESSION['email'], 'Thanh toán đơn hàng', 'Thanh toán thành công');

                $this->render('payment/success_payment');
            } else {
                $this->render('payment/fail_payment');
            }
            exit();
        }
    }
}
