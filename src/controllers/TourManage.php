<?php
class TourManage extends Controller
{
    public $data = [];
    public $model_tour;
    public $file;
    public function __construct()
    {
        if($_SESSION['role'] == "ROLE_ADMIN" || $_SESSION['role'] == "ROLE_MEMBER" && isset($_SESSION['id'])) {
            $this->file = new FileUpload();
            $this->model_tour = $this->model('TourModel');
        } else {
            Header("Location: "._WEB_ROOT."/home");
        }   
    }

    public function index()
    {
        $this->render('admin/tour',$this->data);
    }
    public function create() {
        if (!isset($_POST['action']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            die;
        }
        if ($_POST['action'] == "Add") {    
            $error = 0;

            $tour_address = "";
            $error_tour_address = "";
            if (empty($_POST["tour_address"])) {
                $error_tour_address = 'Địa chỉ bắt buộc';
                $error++;
            } else {
                $tour_address = substr($_POST["tour_address"], 0, 50);
            }

            $tour_description = "";
            $error_tour_description = "";
            if (empty($_POST["tour_description"])) {
                $error_tour_description = 'Miêu tả bắt buộc';
                $error++;
            } else {
                $tour_description = substr($_POST["tour_description"], 0, 50);
            }

            $tour_date = "";
            $error_tour_date = "";
                   
            if (empty($_POST['tour_date'])) {
                $error_tour_date = "Ngày diễn ra bắt buộc";
                $error++;
            } else {
                $tour_date = $_POST['tour_date'];
                list($yyyy,$mm,$dd) = explode('-',$tour_date);
                if (!checkdate($mm,$dd,$yyyy)) {
                    $error_tour_date = "Ngày diễn ra không hợp lệ theo định dạng ngày/tháng/năm";
                    $error++;
                }
            }
            $tour_time = "";
            $error_tour_time = "";
                   
            if (empty($_POST['tour_time'])) {
                $error_tour_time = "Thời gian bắt đầu bắt buộc";
                $error++;
            } else {
                $tour_time = $_POST['tour_time'];
            }
            $tour_time_to = "";
            $error_tour_time_to = "";
                   
            if (empty($_POST['tour_time'])) {
                $error_tour_time_to = "Thời gian kết thúc bắt buộc";
                $error++;
            } else {
                $tour_time_to = $_POST['tour_time_to'];
            }
            $error_tour_image = "";
            $tour_image = "";
            $result = $this->file->fileUpload("tour/","tour_image");
            if (is_array($result)) {
                $tour_image = $result[1];
                if ($error > 0) {
                    unlink("upload/tour/".$tour_image);
                }
            } else {
                $error_tour_image = $result;
                $error++;
            }
                 
            if ($error > 0) {
                $output = array(
                    'error'                       =>    true,
                    'error_tour_date'             =>    $error_tour_date,
                    'error_tour_description'      =>    $error_tour_description,
                    'error_tour_address'          =>    $error_tour_address,
                    'error_tour_image'            =>    $error_tour_image,
                    'error_tour_time'             =>    $error_tour_time,
                    'error_tour_time_to'          =>    $error_tour_time_to
                );
            } else {
                $data = array(
                    'address'       => $tour_address,
                    'date'          => $tour_date,
                    'description'   => $tour_description,
                    'image'         => $tour_image,
                    'time'          => $tour_time,
                    'time_to'       => $tour_time_to
                );

                if ($this->model_tour->createModel($data)) {
                    $output = array(
                        'success'        =>    'Thêm tour thành công',
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

    public function update($id) {
        if (!isset($_POST['action']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            die;
        }
        if ($_POST['action'] == "Edit") {    
            $error = 0;

            $tour_address = "";
            $error_tour_address = "";
            if (empty($_POST["tour_address"])) {
                $error_tour_address = 'Địa chỉ bắt buộc';
                $error++;
            } else {
                $tour_address = substr($_POST["tour_address"], 0, 50);
            }

            $tour_description = "";
            $error_tour_description = "";
            if (empty($_POST["tour_description"])) {
                $error_tour_description = 'Miêu tả bắt buộc';
                $error++;
            } else {
                $tour_description = substr($_POST["tour_description"], 0, 200);
            }

            $tour_date = "";
            $error_tour_date = "";
                   
            if (empty($_POST['tour_date'])) {
                $error_tour_date = "Ngày diễn ra bắt buộc";
                $error++;
            } else {
                $tour_date = $_POST['tour_date'];
                list($yyyy,$mm,$dd) = explode('-',$tour_date);
                if (!checkdate($mm,$dd,$yyyy)) {
                    $error_tour_date = "Ngày diễn ra không hợp lệ theo định dạng ngày/tháng/năm";
                    $error++;
                }
            }
            $tour_time = "";
            $error_tour_time = "";
                   
            if (empty($_POST['tour_time'])) {
                $error_tour_time = "Thời gian bắt đầu bắt buộc";
                $error++;
            } else {
                $tour_time = $_POST['tour_time'];
            }
            $tour_time_to = "";
            $error_tour_time_to = "";
                   
            if (empty($_POST['tour_time'])) {
                $error_tour_time_to = "Thời gian kết thúc bắt buộc";
                $error++;
            } else {
                $tour_time_to = $_POST['tour_time_to'];
            }
            $error_tour_image = "";
            $tour_image = "";
            if ($_FILES['tour_image']['name'] != "") {
                $result = $this->file->fileUpload("tour/","tour_image");
                if (is_array($result)) {
                    $tour_image = $result[1];
                    if ($error > 0) {
                        unlink("upload/tour/".$tour_image);
                    } else {                     
                        unlink("upload/tour/".$this->model_tour->getDetailModel($id)["image"]);
                    }
                } else {
                    $error_tour_image = $result;
                    $error++;
                }
            }
            
            
            if ($error > 0) {
                $output = array(
                    'error'                       =>    true,
                    'error_tour_date'             =>    $error_tour_date,
                    'error_tour_description'      =>    $error_tour_description,
                    'error_tour_address'          =>    $error_tour_address,
                    'error_tour_image'            =>    $error_tour_image,
                    'error_tour_time'             =>    $error_tour_time,
                    'error_tour_time_to'          =>    $error_tour_time_to
                );
            } else {
                if ($tour_image != "") {
                    $data = array(
                        'address'        => $tour_address,
                        'date'           => $tour_date,
                        'description'    => $tour_description,
                        'image'          =>  $tour_image,
                        'time'           => $tour_time,
                        'time_to'        => $tour_time_to
                    );
                } else {
                    $data = array(
                        'address'       => $tour_address,
                        'date'          => $tour_date,
                        'description'   => $tour_description,
                        'time'          => $tour_time,
                        'time_to'       => $tour_time_to
                    );
                }
                

                if ($this->model_tour->updateModel($id,$data)) {
                    $output = array(
                        'success'        =>    'Thay đổi tour thành công',
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

    public function delete($id) {
        if ($_POST['action'] == "delete") {
            if($this->model_tour->deleteModel($id)) {
                echo "Xóa người dùng thành công";
            }
        }
    }
    
    public function list() 
    {
        if ($_POST['action'] == 'fetch') {
            $condition = " ";
            if (!empty($_POST["search"]["value"])) {
                $condition = 'WHERE tour.address LIKE "%' . $_POST["search"]["value"] . '%" OR tour.date LIKE "%' . $_POST["search"]["value"] . '%" ';
            }
            if (isset($_POST["order"])) {
                $column = $_POST['order']['0']['column'];
                if ($column == "0") {
                    $condition .= '
                    ORDER BY 1 ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 2) {
                    $condition .= '
                    ORDER BY address ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 3) {
                    $condition .= '
                    ORDER BY date ' . $_POST['order']['0']['dir'] . '
                    ';
                }
            }
            if ($_POST["length"] != -1) {
                $condition .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
            }
            $result = $this->model_tour->getListModel($condition);
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
                $sub_array[] = '<img src="' . _WEB_ROOT . '/upload/tour/' . $row["image"] . '" class="img-thumbnail" width="75">';
                $sub_array[] = $row["address"];
                $sub_array[] = $row["date"];
                $sub_array[] = date('h:i a', strtotime($row["time"]))." - ". date('h:i a', strtotime($row["time_to"]));
                $sub_array[] = $row["description"];
                if ($_SESSION['role'] == "ROLE_ADMIN") {
                    $sub_array[] = '<button type="button" name="view_tour" class="btn btn-info btn-sm view_tour" id="' . $row["id"] . '">View</button>';
                    $sub_array[] = '<button type="button" name="edit_tour" class="btn btn-primary btn-sm edit_tour" id="' . $row["id"] . '">Edit</button>';
                    $sub_array[] = '<button type="button" name="delete_tour" class="btn btn-danger btn-sm delete_tour" id="' . $row["id"] . '">Delete</button>';   
                } else {
                    $sub_array[] = '<button type="button" name="view_tour" class="btn btn-info btn-sm view_tour" id="' . $row["id"] . '">View</button>';
                    $sub_array[] = '<button type="button" name="edit_tour" class="btn btn-primary btn-sm edit_tour" id="' . $row["id"] . '" disabled>Edit</button>';
                    $sub_array[] = '<button type="button" name="delete_tour" class="btn btn-danger btn-sm delete_tour" id="' . $row["id"] . '" disabled>Delete</button>';   
                }
                
                $data1[] = $sub_array;
            }
            $output = array(
                "draw"                =>    intval($_POST["draw"]),
                "recordsTotal"        =>    $filtered_rows,
                "recordsFiltered"    =>     count($this->model_tour->getListModel()),
                "data"                =>    $data1
            );
            // print_r($_POST);
            echo json_encode($output);
        }
    }

    public function detail($id) {
        if ($_POST['action'] == "single_fetch") {
            $dataDetail  = $this->model_tour->getListModel("WHERE id = $id");
            $output = [];
            foreach ($dataDetail as $row) {
                $output['tour_image'] = "upload/tour/".$row['image'];
                $output['tour_address'] = $row['address'];
                $output['tour_date'] = $row['date'];
                $output['tour_description'] = $row['description'];
                $output['tour_time'] = $row['time'];
                $output['tour_time_to'] = $row['time_to'];
            }
            echo json_encode($output);
        }
    }
}
