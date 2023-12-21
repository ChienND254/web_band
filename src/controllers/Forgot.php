
<?php
class Forgot extends Controller
{
    public $data = [];
    public $model_user;

    public function __construct()
    {
        $this->model_user = $this->model('UserModel');
    }

    public function index()
    {
        if (isset($_SESSION['id'])) {
            Header("Location:" . _WEB_ROOT . "/home");
            // session_destroy();
        } else {
            $this->data['err_email'] = "";
            $this->data['success'] = "";
            $this->render('forgot/forgot', $this->data);
        }
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Header("Location:" . _WEB_ROOT . "/forgot");
            die;
        }
        $email = $_POST['email'];
        $user = ($this->model_user->findByEmail($email))[0];
        if ($email == '') {
            $this->data['err_email'] = "Email is required";
            $this->data['success'] = "";
            $this->render('forgot/forgot', $this->data);
        } else {
            if (isset($user)) {
                $length = 32;
                $randomBytes = openssl_random_pseudo_bytes($length);
                $token = bin2hex($randomBytes);
                $user['reset_token'] = $token;
                $this->model_user->updateModel($user['id'], $user);
                $mail = new MailSender();
                $mail->sendMail($email, 'Password reset', '<a href="'._WEB_ROOT.'/change/index/'.$token.'">Enter the link to reset password</a>');
                $this->data['err_email'] = "";
                $this->data['success'] = "Success check mail";
                $this->render('forgot/forgot', $this->data);
            } else {
                $this->data['err_email'] = "Email not exist";
                $this->data['success'] = "";
                $this->render('forgot/forgot', $this->data);
            }
        }
    }
}