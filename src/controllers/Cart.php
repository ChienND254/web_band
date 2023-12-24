<?php
class Cart extends Controller
{
    public $data = [];
    public $model_user;
    public $model_order;
    public $model_order_line;
    public $model_ticket;
    public $model_tour;
    public $file;

    public function __construct()
    {
        if(isset($_SESSION['id'])) {
            $this->file = new FileUpload();
            $this->model_user = $this->model('UserModel');
            $this->model_order = $this->model('OrderModel');
            $this->model_order_line = $this->model('OrderLineModel');
            $this->model_ticket = $this->model('TicketModel');
            $this->model_tour = $this->model('TourModel');
        } else {
            Header("Location: "._WEB_ROOT."/login");
        }
       
    }

    public function index()
    {
        $dataUser  = $this->model_user->getDetailModel($_SESSION['id']);
        $cart = json_decode($_COOKIE['cart'], true);
        for ($i = 0; $i < sizeof($cart); $i++) {
            $cart[$i]['tour_id'] = $this->model_tour->getDetailModel($cart[$i]['tour_id']);
        }

        $this->data['cart_list'] = $cart;
        $this->data['user_context'] = $dataUser;

        $this->render('cart/cart', $this->data);
    }

    public function create()
    {
        $ticket = [];
        $totalPrice = [];
        $cart = json_decode($_COOKIE['cart'], true);
        for ($i = 0; $i < sizeof($cart); $i++) {
            $ticket[$i] = $this->model_ticket->getTicketInStock($cart[$i]['tour_id'], $cart[$i]['quantity']);
            $totalPrice[$i] = 0;
            for ($j = 0; $j < sizeof($ticket[$i]); $j++) {
                $ticket[$i][$j]['status'] = 'OUT_OF_STOCK';
                $totalPrice[$i] = $totalPrice[$i] + $ticket[$i][$j]['price'];
                $this->model_ticket->updateModel($ticket[$i][$j]['id'], $ticket[$i][$j]);
            }
        }

        $dataUser = $this->model_user->getDetailModel($_SESSION['id']);
        $currentDateTime = new DateTime();
        $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
        $dataOrder = [
            'address' => $dataUser['address'],
            'order_date' => $formattedDateTime,
            'user_id' => $dataUser['id'],
            'total_price' => array_sum($totalPrice),
        ];
        $this->model_order->createModel($dataOrder);
        $order = ($this->model_order->getLastModel())[0];

        for ($i = 0; $i < sizeof($ticket); $i++) {
            for ($j = 0; $j < sizeof($ticket[$i]); $j++) {
                $dataOrderLine = [
                    'ticket_id' => $ticket[$i][$j]['id'],
                    'order_id' => $order['id'],
                    'price' => $ticket[$i][$j]['price'],
                ];
                $this->model_order_line->createModel($dataOrderLine);
            }
        }

        setcookie("cart", json_encode([]), time() + (86400 * 30), "/");
        Header("Location:"._WEB_ROOT."/payment");
    }
    public function readfile($imgName)
    {
        $this->file->getFileContent('tour/' . $imgName);
    }
}