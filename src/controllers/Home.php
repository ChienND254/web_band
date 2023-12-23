<?php
class Home extends Controller
{
    public $data = [];
    public $model_tour;

    public function __construct()
    {
        // $this->model_home = $this->model('HomeModel');
        $this->model_tour = $this->model('TourModel');
    }

    public function index()
    {
        $dataList  = $this->model_tour->getListModel();
        $this->data['tour_list'] = $dataList;

        $this->render('home/index', $this->data);
    }

    public function create()
    {
        $currentDateTime = new DateTime();
        $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
        $datar = [
            'email' => 'ng@gmail.com',
            'password' => 'anhassnh2202',
            'name' => 'nbva3',
            'phone' => '00232135',
            'address' => 'Ha Noii',
            'role' => 'ROLE_USER',
            'create_date' => $formattedDateTime,
        ];
        return $this->model_tour->createModel($datar);
    }

    public function update($id)
    {
        $currentDateTime = new DateTime();
        $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
        $datar = [
            'email' => 'ng@gmail.com',
            'password' => 'anhanh2002',
            'name' => 'anhanh',
            'phone' => '00232135',
            'address' => 'Ha Noii',
            'role' => 'ROLE_USER',
            'create_date' => $formattedDateTime,
        ];
        return $this->model_tour->updateModel($id, $datar);
    }

    public function delete($id)
    {
        return $this->model_tour->deleteModel($id);
    }

    public function list()
    {
        $data = $this->model_tour->getListModel();
        echo '<pre>';
        echo print_r($data);
        echo '</pre>';
    }

    public function detail($id)
    {
        $dataDetail  = $this->model_tour->getDetailModel($id);

        $this->data['tour_detail'] = $dataDetail;
        $this->render('tour/detail', $this->data);
    }

    public function send_mail()
    {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $message = $_POST['message'];
        $mail = new MailSender();
        $mail->sendMail('nguyenbavietanh2002@gmail.com', 'Contact', '
        <h1>Thông tin liên hệ</h1>
        <p>Email: ' . $email . '</p>
        <p>Name: ' . $name . '</p>
        <p>Message: ' . $message . '</p>
        ');
        $this->render('home/index', $this->data);
    }
}