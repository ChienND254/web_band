<?php
class Tour extends Controller
{
    public $data = [];
    public $model_tour;
    public $file;

    public function __construct()
    {
        $this->file = new FileUpload();
        $this->model_tour = $this->model('TourModel');
    }

    public function index()
    {
        echo "Danh sách Tour diễn";
    }

    public function list()
    {
        $dataList  = $this->model_tour->getListModel();
        $this->data['tour_list'] = $dataList;
        $this->render('tour/list', $this->data);
    }

    public function detail($id)
    {
        $dataDetail  = $this->model_tour->getDetailModel($id);
        $dataNumTicket  = $this->model_tour->getNumTicket($id);
        if (sizeof($dataNumTicket) > 0) {
            $dataNumTicket = $dataNumTicket[0]['number'];
        } else {
            $dataNumTicket = 0;
        }
        $this->data['tour_detail'] = $dataDetail;
        $this->data['num_ticket'] = $dataNumTicket;
        $this->render('tour/detail', $this->data);
    }

    public function readfile($imgName)
    {
        $this->file->getFileContent('tour/' . $imgName);
    }

    public function addCart()
    {
        $tourID = $_POST["tour_id"];
        $quantity = $_POST["quantity"];
        $cart = json_decode($_COOKIE['cart'], true);

        $inCart = false;
        for ($i = 0; $i < sizeof($cart); $i++) {
            if ($cart[$i]['tour_id'] == $tourID) {
                $cart[$i]['quantity'] = $cart[$i]['quantity'] + $quantity;
                $inCart = true;
                break;
            }
        }
        if (!$inCart) {
            array_push($cart, [
                "tour_id" => $tourID,
                "quantity" => $quantity,
            ]);
        }
        setcookie("cart", json_encode($cart), time() + (86400 * 30), "/");
        Header("Location:" . _WEB_ROOT . "/cart");
    }
}