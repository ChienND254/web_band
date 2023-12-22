<?php
class User extends Controller
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
        $this->file = new FileUpload();
        $this->model_user = $this->model('UserModel');
        $this->model_order = $this->model('OrderModel');
        $this->model_order_line = $this->model('OrderLineModel');
        $this->model_ticket = $this->model('TicketModel');
        $this->model_tour = $this->model('TourModel');
    }

    public function index()
    {
        if (isset($_SESSION['id'])) {
            $dataUser  = $this->model_user->getDetailModel($_SESSION['id']);
            $dataOrder  = $this->model_order->getListModel("WHERE user_id = " . $_SESSION['id']);

            for ($i = 0; $i < sizeof($dataOrder); $i++) {
                $dataOrder[$i]['order_line'] = $this->model_order_line->getListModel("WHERE order_id = " . $dataOrder[$i]['id']);
                for ($j = 0; $j < sizeof($dataOrder[$i]['order_line']); $j++) {
                    $dataOrder[$i]['order_line'][$j] = $this->model_ticket->getDetailModel($dataOrder[$i]['order_line'][$j]['ticket_id']);
                }
            }


            // $this->data['cart_list'] = $cart;

            $this->data['user_context'] = $dataUser;
            $this->data['order'] = $dataOrder;
            
            $this->render('user/user', $this->data);
        } else {
            Header("Location:" . _WEB_ROOT . "/login");
        }
    }

    public function logout()
    {
        session_destroy();
        Header("Location:" . _WEB_ROOT . "/login");
    }

    public function update()
    {
        $dataUser  = $this->model_user->getDetailModel($_SESSION['id']);
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $dataUser['email'] = $email;
        $dataUser['name'] = $name;
        $dataUser['phone'] = $phone;
        $dataUser['address'] = $address;
        $this->model_user->updateModel($_SESSION['id'], $dataUser);
        Header("Location:" . _WEB_ROOT . "/user");
    }

    public function change_avatar()
    { 
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Header("Location:" . _WEB_ROOT . "/login");
            die;
        }
        if ($_FILES['fileToUpload']['name'] != "") {
            $filename = $this->file->fileUpload('user/', 'fileToUpload')[1];
            $dataUser  = $this->model_user->getDetailModel($_SESSION['id']);
            if ($filename != "") {
                unlink("upload/user/".$dataUser['image']);
            }
            $dataUser['image'] = $filename;
            
            $this->model_user->updateModel($_SESSION['id'], $dataUser);
            $this->index();
            
        } else {
            Header("Location:" . _WEB_ROOT . "/user");
        }
    }

    public function readfile($imgName)
    {
        $this->file->getFileContent('user/' . $imgName);
    }
}