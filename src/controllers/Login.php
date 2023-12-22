<?php
class Login extends Controller
{
    public $data = [];
    public $model_user;

    public function __construct()
    {
        $this->model_user = $this->model('UserModel');
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Header("Location:" . _WEB_ROOT . "/login");
            die;
        }
        // if ($_POST[''])
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->model_user->findByEmail($email);
        if ($email == '' && $password == '') {
            $this->data['err_email'] = "Email is required";
            $this->data['err_password'] = "Password is required";
            $this->render('login/login', $this->data);
        } else {
            if (isset($user[0])) {
                if ($password == '') {
                    $this->data['err_email'] = "";
                    $this->data['err_password'] = "Password is required";
                    $this->render('login/login', $this->data);
                } else {
                    if (password_verify($password, $user[0]['password'])) {
                        $_SESSION['id'] = $user[0]['id'];
                        $_SESSION['role'] = $user[0]['role'];
                        if ($user[0]['role'] == "ROLE_ADMIN" || $user[0]['role'] == "ROLE_MEMBER") {
                            Header("Location:" . _WEB_ROOT . "/admin");
                        } else {

                            Header("Location:" . _WEB_ROOT . "/home");
                        }
                    } else {
                        $this->data['err_email'] = "";
                        $this->data['err_password'] = "Wrong password";
                        $this->render('login/login', $this->data);
                    }
                }
            } else {
                $this->data['err_email'] = "Email not exist";
                $this->data['err_password'] = "";
                $this->render('login/login', $this->data);
            }
        }
    }

    public function index()
    {
        if (isset($_SESSION['id'])) {
            Header("Location:" . _WEB_ROOT . "/home");
            // session_destroy();
        } else {
            $this->data['err_email'] = "";
            $this->data['err_password'] = "";
            $this->render('login/login', $this->data);
        }
    }
}