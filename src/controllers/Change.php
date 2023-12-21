<?php
class Change extends Controller
{
    public $data = [];
    public $model_user;
    private $user;

    public function __construct()
    {
        $this->model_user = $this->model('UserModel');
    }

    public function index($reset_token, $password='', $confirm_password='')
    {
        $this->data['reset_token'] = $reset_token;
        $this->data['err_password'] = $password;
        $this->data['err_confirm_password'] = $confirm_password;
        $this->render('change/change', $this->data);
    }

    public function authenticate($reset_token)
    {
        $this->user = ($this->model_user->resetPassword($reset_token))[0];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        $this->data['err_password'] = "";
        $this->data['err_confirm_password'] = "";

        $err_validate = [];

        if ($password == '') {
            $err_validate['err_password'] = "Password is required";
        }
        if ($confirmPassword == '') {
            $err_validate['err_password'] = "";
            $err_validate['err_confirm_password'] = "Confirm password is required";
        } else if ($confirmPassword != $password) {
            $err_validate['err_password'] = "";
            $err_validate['err_confirm_password'] = "Password and Confirm Password do not match";
        }

        if (sizeof($err_validate) == 0) {
            $options = [
                'cost' => 11
            ];
            $this->user['password'] = password_hash($password, PASSWORD_BCRYPT, $options);
            $this->model_user->updateModel($this->user['id'], $this->user);
            Header("Location:" . _WEB_ROOT . "/login");
        } else {
            Header("Location:" . _WEB_ROOT . "/change/index/".$reset_token."/".$err_validate['err_password']."/".$err_validate['err_confirm_password']);
        }
    }

}