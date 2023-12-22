<?php
class Admin extends Controller
{
    public $data = [];
    public $model_admin;

    public function __construct()
    {
        $this->model_admin = $this->model('AdminModel');
    }

    public function index()
    {
        if($_SESSION['role'] == "ROLE_ADMIN" || $_SESSION['role'] == "ROLE_MEMBER" && isset($_SESSION['id'])) {

            $this->render('admin/admin',$this->data);
        } else {
            Header("Location: "._WEB_ROOT."/home");
        }
    }
}
