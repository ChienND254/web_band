<?php
class UserManage extends Controller
{
    public $model_user;
    public $file;
    public function __construct()
    {
        if($_SESSION['role'] == "ROLE_ADMIN" || $_SESSION['role'] == "ROLE_MEMBER" && isset($_SESSION['id'])) {
            $this->file = new FileUpload();
            $this->model_user = $this->model('UserModel');
        } else {
            Header("Location: "._WEB_ROOT."/home");
        }
        
    }

    public function index()
    {
        $this->render('admin/user');
    }
    public function create()
    {
        if (!isset($_POST['action']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            die;
        }
        if ($_POST['action'] == "Add") {    
            $error = 0;
            
            $user_email = "";
            $error_user_email = "";
            if (empty($_POST["user_email"])) {
                $error_user_email = 'Địa chỉ email bắt buộc';
                $error++;
            } else {
                if (filter_var($_POST["user_email"], FILTER_VALIDATE_EMAIL) && empty($this->model_user->findByEmail($_POST['user_email']))) {
                    $user_email = substr($_POST["user_email"], 0, 50);
                } else {
                    $error_user_email = 'Email không đúng định dạng hoặc email tồn tại';
                    $error++;
                }
            }

            $user_name = "";
            $error_user_name = "";
            if (empty($_POST["user_name"])) {
                $error_user_name = 'Tên bắt buộc';
                $error++;
            } else {
                if (ctype_alpha($_POST["user_name"])) {
                    $user_name = substr($_POST["user_name"], 0, 30);
                } else {
                    $error_user_name = 'Tên chỉ gồm các chữ cái';
                    $error++;
                }
            }

            $user_address = "";
            $error_user_address = "";
            if (empty($_POST["user_address"])) {
                $error_user_address = 'Địa chỉ bắt buộc';
                $error++;
            } else {
                $user_address = substr($_POST["user_address"], 0, 50);
            }

            $user_psw1 = "";
            $error_user_psw1 = "";
            $error_user_psw2 = "";
            if (empty($_POST["psw1"])) {
                $error_user_psw1 = "Mật khẩu bắt buộc";
                $error++;
            } else {
                $pattern = "#.*^(?=.{8,64})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#";
                if (preg_match($pattern, $_POST["psw1"])) {
                    $user_psw1 = $_POST["psw1"];
                } else {
                    $error_user_psw1 = "Mật khẩu gồm 1 số, 1 chữ hoa, 1 ký tự đặc biệt, và có ít nhất 8 ký";
                    $error++;
                }
            }
            if (empty($_POST['psw2'])) {
                $error_user_psw2 = "Mật khẩu nhập lại bắt buộc";
                $error++;
            } else {
                if ($_POST['psw2'] != $_POST['psw1']) {
                    $error_user_psw2 = "Mật khẩu không giống nhau";
                    $error++;
                }
            }

            $user_phone = "";
            $error_user_phone = "";
            if (empty($_POST['user_phone'])) {
                $error_user_phone = "Số điện thoại bắt buộc";
                $error++;
            } else {
                if (ctype_digit($_POST['user_phone'])) {
                    $user_phone = substr($_POST['user_phone'], 0, 20);
                } else {
                    $error_user_phone = "Số điện thoại chỉ gồm số";
                    $error++;
                }
            }
            $error_user_image = "";
            $user_image = "";
            $result = $this->file->fileUpload("user/","user_image");
            if (is_array($result)) {
                $user_image = $result[1];
                if ($error > 0) {
                    unlink("upload/user/".$user_image);
                }
            } else {
                $error_user_image = $result;
                $error++;
            }
            
            
            if ($error > 0) {
                $output = array(
                    'error'                       =>    true,
                    'error_user_name'             =>    $error_user_name,
                    'error_user_email'            =>    $error_user_email,
                    'error_user_password1'        =>    $error_user_psw1,
                    'error_user_password2'        =>    $error_user_psw2,
                    'error_user_phone'            =>    $error_user_phone,
                    'error_user_address'          =>    $error_user_address,
                    'error_user_image'            =>    $error_user_image
                );
            } else {
                $data = array(
                    'email' => $user_email,
                    'password' => password_hash($user_psw1, PASSWORD_DEFAULT),
                    'name' => $user_name,
                    'phone' => $user_phone,
                    'address' => $user_address,
                    'role' => $_POST['user_role'],
                    'image'  =>  $user_image
                );

                if ($this->model_user->createModel($data)) {
                    $output = array(
                        'success'        =>    'Thêm người dùng thành công',
                    );
                } else {
                    $output = array(
                        'error'     =>    true
                    );
                }
            }
            echo json_encode($output);
        }
    }
    public function update($id)
    {
        if (!isset($_POST['action']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            die;
        }
        if ($_POST['action'] == "Edit") {
            $error = 0;
            
            $user_name = "";
            $error_user_name = "";
            if (empty($_POST["user_name"])) {
                $error_user_name = 'Tên bắt buộc';
                $error++;
            } else {
                if (ctype_alpha($_POST["user_name"])) {
                    $user_name = substr($_POST["user_name"], 0, 30);
                } else {
                    $error_user_name = 'Tên chỉ gồm các chữ cái';
                    $error++;
                }
            }

            $user_address = "";
            $error_user_address = "";
            if (empty($_POST["user_address"])) {
                $error_user_address = 'Địa chỉ bắt buộc';
                $error++;
            } else {
                $user_address = substr($_POST["user_address"], 0, 50);
            }

            $user_psw1 = "";
            $error_user_psw1 = "";
            if (empty($_POST["psw1"])) {
            } else {
                $pattern = "#.*^(?=.{8,64})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#";
                if (preg_match($pattern, $_POST["psw1"])) {
                    $user_psw1 = $_POST["psw1"];
                } else {
                    $error_user_psw1 = "Mật khẩu gồm 1 số, 1 chữ hoa, 1 ký tự đặc biệt, và có ít nhất 8 ký";
                    $error++;
                }
            }

            $user_phone = "";
            $error_user_phone = "";
            if (empty($_POST['user_phone'])) {
                $error_user_phone = "Số điện thoại bắt buộc";
                $error++;
            } else {
                if (ctype_digit($_POST['user_phone'])) {
                    $user_phone = substr($_POST['user_phone'], 0, 20);
                } else {
                    $error_user_phone = "Số điện thoại chỉ gồm số";
                    $error++;
                }
            }
            $error_user_image = "";
            $user_image = "";
            if ($_FILES['user_image']['name'] != "") {
                $result = $this->file->fileUpload("user/","user_image");
                if (is_array($result)) {
                    $user_image = $result[1];
                    if ($error > 0) {
                        unlink("upload/user/".$user_image);
                    } else {                     
                        unlink("upload/user/".$this->model_user->getDetailModel($id)["image"]);
                    }
                } else {
                    $error_user_image = $result;
                    $error++;
                }
            }
            $role = "ROLE_ADMIN";
            if(!empty($_POST['user_role'])) {
                $role = $_POST['user_role'];
            }
            if ($error > 0) {
                $output = array(
                    'error'                       =>    true,
                    'error_user_name'             =>    $error_user_name,
                    'error_user_password1'        =>    $error_user_psw1,
                    'error_user_phone'            =>    $error_user_phone,
                    'error_user_address'          =>    $error_user_address,
                    'error_user_image'            =>    $error_user_image
                );
            } else {
                if ($user_image != "") {
                    $data = array(
                        'password'      => password_hash($user_psw1, PASSWORD_DEFAULT),
                        'name'          => $user_name,
                        'phone'         => $user_phone,
                        'address'       => $user_address,
                        'role'          => $role,
                        'image'         =>  $user_image 
                    );
                } else {
                    $data = array(
                        'password'      => password_hash($user_psw1, PASSWORD_DEFAULT),
                        'name'          => $user_name,
                        'phone'         => $user_phone,
                        'address'       => $user_address,
                        'role'          => $role,
                    );
                }
                if ($this->model_user->updateModel($id,$data)) {
                    $output = array(
                        'success'        =>    'Thay đổi thành công',
                    );
                } else {
                    $output = array(
                        'error'     =>    true
                    );
                }
            }
            echo json_encode($output);
        }
    }

    public function delete($id)
    {
        
        if ($_POST['action'] == "delete") {
            if($this->model_user->deleteModel($id)) {
                echo "Xóa người dùng thành công";
            }
        }
    }

    public function list()
    {
        if ($_POST['action'] == 'fetch') {
            $condition = " ";
            if (!empty($_POST["search"]["value"])) {
                $condition = 'WHERE user.name LIKE "%' . $_POST["search"]["value"] . '%" OR user.email LIKE "%' . $_POST["search"]["value"] . '%"';
            }
            if (isset($_POST["order"])) {
                $column = $_POST['order']['0']['column'];
                if ($column == "0") {
                    $condition .= '
                    ORDER BY 1 ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 2) {
                    $condition .= '
                    ORDER BY 4 ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 3) {
                    $condition .= '
                    ORDER BY 2 ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 6) {
                    $condition .= '
                    ORDER BY 7 ' . $_POST['order']['0']['dir'] . '
                    ';
                }
            }
            if ($_POST["length"] != -1) {
                $condition .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
            }
            $result = $this->model_user->getListModel($condition);
            $data1 = array();
            $filtered_rows = 0;
            if (count($result) < 10) {
                $filtered_rows = count($result);
            } else {
                $filtered_rows = 10;
            }

            foreach ($result as $row) {
                $sub_array = array();
                $sub_array[] = $row['id'];
                $sub_array[] = '<img src="' . _WEB_ROOT . '/upload/user/' . $row["image"] . '" class="img-thumbnail" width="75">';
                $sub_array[] = $row["name"];
                $sub_array[] = $row["email"];
                $sub_array[] = $row["address"];
                $sub_array[] = $row["phone"];
                $sub_array[] = $row["role"];
                if ($_SESSION['role'] == "ROLE_MEMBER") {
                    $sub_array[] = '<button type="button" name="view_user" class="btn btn-info btn-sm view_user" id="' . $row["id"] . '">View</button>';
                    $sub_array[] = '<button type="button" name="edit_user" class="btn btn-primary btn-sm edit_user" id="' . $row["id"] . '" disabled>Edit</button>';
                    $sub_array[] = '<button type="button" name="delete_user" class="btn btn-danger btn-sm delete_user" id="' . $row["id"] . '" disabled>Delete</button>';
                } else {
                    $sub_array[] = '<button type="button" name="view_user" class="btn btn-info btn-sm view_user" id="' . $row["id"] . '">View</button>';
                    $sub_array[] = '<button type="button" name="edit_user" class="btn btn-primary btn-sm edit_user" id="' . $row["id"] . '">Edit</button>';
                    $sub_array[] = '<button type="button" name="delete_user" class="btn btn-danger btn-sm delete_user" id="' . $row["id"] . '">Delete</button>';
                }
                
                $data1[] = $sub_array;
            }
            $output = array(
                "draw"                =>    intval($_POST["draw"]),
                "recordsTotal"        =>    $filtered_rows,
                "recordsFiltered"    =>     count($this->model_user->getListModel()),
                "data"                =>    $data1
            );
            // print_r($_POST);
            echo json_encode($output);
        }
    }

    public function detail($id)
    {
        if ($_POST['action'] == "single_fetch") {
            $dataDetail  = $this->model_user->getListModel("WHERE id = $id");
            $output = [];
            foreach ($dataDetail as $row) {
                $output['user_image'] = "upload/user/".$row['image'];
                $output['user_name'] = $row['name'];
                $output['user_email'] = $row['email'];
                $output['user_phone'] = $row['phone'];
                $output['user_role'] = $row['role'];
                $output['user_address'] = $row['address'];
            }
            echo json_encode($output);
        }
    }
}
