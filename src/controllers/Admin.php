<?php
class Admin extends Controller
{
    public $data = [];
    public $model_ticket;
    public $model_tour;
    public function __construct()
    {
        $this->model_ticket = $this->model('TicketModel');
        $this->model_tour = $this->model('TourModel');
    }

    public function index()
    {
        if($_SESSION['role'] == "ROLE_ADMIN" || $_SESSION['role'] == "ROLE_MEMBER" && isset($_SESSION['id'])) {

            $this->render('admin/admin',$this->data);
        } else {
            Header("Location: "._WEB_ROOT."/home");
        }
    }
    public function resetTable() {
        $data = [
            'status' => "IN_STOCK"
        ];
        for ($i = 1; $i <= 100;$i++) {
            $this->model_ticket->updateModel($i,$data);
        }
        Header("Location: "._WEB_ROOT."/admin");
    }
}
