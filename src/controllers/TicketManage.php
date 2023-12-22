<?php
class TicketManage extends Controller
{
    public $data = [];
    public $model_tour;
    public $model_ticket;
    public $file;
    public function __construct()
    {
        if($_SESSION['role'] == "ROLE_ADMIN" || $_SESSION['role'] == "ROLE_MEMBER" && isset($_SESSION['id'])) {
            $this->file = new FileUpload();
            $this->model_tour = $this->model('TourModel');
            $this->model_ticket = $this->model('TicketModel');
        } else {
            Header("Location: "._WEB_ROOT."/home");
        }
    }

    public function index()
    {
        $this->render('admin/ticket',$this->data);
    }
    public function create() {
        if (!isset($_POST['action']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            die;
        }
        if ($_POST['action'] == "tour_list") {
            $tour = $this->model_tour->getListModel();
            foreach($tour as $row){
		        echo '<option value="'.$row["id"].'">'.$row["address"].'</option>';
	        }
           
        }
        if ($_POST['action'] == "Add") {    
            $error = 0;

            $data["tour"] = $this->model_tour->getListModel();
            $ticket_price = "";
            $error_ticket_price = "";
            if (empty($_POST["ticket_price"])) {
                $error_ticket_price = 'Giá tiền bắt buộc';
                $error++;
            } else {
                $ticket_price = $_POST["ticket_price"];
            }

            $ticket_quantity = "";
            $error_ticket_quantity = "";
            if (empty($_POST["ticket_quantity"])) {
                $error_ticket_quantity = 'Số lượng bắt buộc';
                $error++;
            } else {
                $ticket_price = $_POST["ticket_quantity"];
            }
            $ticket_time = "";
            $error_ticket_time = "";
                   
            if (empty($_POST['ticket_time'])) {
                $error_ticket_time = "Thời gian bắt đầu bắt buộc";
                $error++;
            } else {
                $ticket_time = $_POST['ticket_time'];
            }
            $ticket_time_to = "";
            $error_ticket_time_to = "";
                   
            if (empty($_POST['ticket_time_to'])) {
                $error_ticket_time_to = "Thời gian kết thúc bắt buộc";
                $error++;
            } else {
                $ticket_time_to = $_POST['ticket_time_to'];
            }     
            
            $ticket_tour = "";
            $error_ticket_tour = "";
                   
            if (empty($_POST['ticket_tour'])) {
                $error_ticket_tour = "Bắt buộc chọn tour";
                $error++;
            } else {
                $ticket_tour = $_POST['ticket_tour'];
            }
            if ($error > 0) {
                $output = array(
                    'error'                         =>    true,
                    'error_ticket_time'             =>    $error_ticket_time,
                    'error_ticket_time_to'          =>    $error_ticket_time_to,
                    'error_ticket_price'            =>    $error_ticket_price,
                    'error_ticket_tour'             =>    $error_ticket_tour,
                    'error_ticket_quantity'         =>    $error_ticket_quantity
                );
            } else {
                $data = array(
                    'time'      => $ticket_time,
                    'time_to'   => $ticket_time_to,
                    'price'     => $ticket_price,
                    'tour_id'   => $ticket_tour,
                    'quantity'   => $ticket_quantity
                );
                if ($this->model_ticket->createModel($data)) {
                    $output = array(
                        'success'        =>    'Tạo vé thành công',
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

            $ticket_price = "";
            $error_ticket_price = "";
            if (empty($_POST["ticket_price"])) {
                $error_ticket_price = 'Giá tiền bắt buộc';
                $error++;
            } else {
                if (!intval($_POST['ticket_price'])) {
                    $error_ticket_price = 'Giá tiền không đúng định dạng';
                    $error++;
                } else {
                    $ticket_price = $_POST["ticket_price"];
                }
            }
            $ticket_quantity = "";
            $error_ticket_quantity = "";
            if (empty($_POST["ticket_quantity"])) {
                $error_ticket_quantity = 'Số lượng bắt buộc';
                $error++;
            } else {
                $ticket_quantity = $_POST["ticket_quantity"];
            }
            $ticket_time = "";
            $error_ticket_time = "";
                   
            if (empty($_POST['ticket_time'])) {
                $error_ticket_time = "Thời gian bắt đầu bắt buộc";
                $error++;
            } else {
                $ticket_time = $_POST['ticket_time'];
            }
            $ticket_time_to = "";
            $error_ticket_time_to = "";
                   
            if (empty($_POST['ticket_time'])) {
                $error_ticket_time_to = "Thời gian kết thúc bắt buộc";
                $error++;
            } else {
                $ticket_time_to = $_POST['ticket_time_to'];
            }
            
            
            if ($error > 0) {
                $output = array(
                    'error'                         =>    true,
                    'error_ticket_time'             =>    $error_ticket_time,
                    'error_ticket_time_to'          =>     $error_ticket_time_to,
                    'error_ticket_price'            =>    $error_ticket_price,
                    'error_ticket_quantity'         =>    $error_ticket_quantity
                );
            } else {
                $data = array(
                    'time'      => $ticket_time,
                    'time_to'   => $ticket_time_to,
                    'price'     => $ticket_price,
                    'quantity'   => $ticket_quantity

                );
                if ($this->model_ticket->updateModel($id,$data)) {
                    $output = array(
                        'success'        =>    'Thay đổi vé thành công',
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
            if($this->model_ticket->deleteModel($id)) {
                echo "Xóa vé thành công";
            }
        }
    }
    
    public function list() 
    {
        if ($_POST['action'] == 'fetch') {
            $condition = "INNER JOIN ticket ON ticket.tour_id = tour.id ";
            if (!empty($_POST["search"]["value"])) {
                $condition .= 'WHERE tour.address LIKE "%' . $_POST["search"]["value"] . '%" OR tour.date LIKE "%' . $_POST["search"]["value"] . '%" ';
            }
            if (isset($_POST["order"])) {
                $column = $_POST['order']['0']['column'];
                if ($column == "0") {
                    $condition .= '
                    ORDER BY ticket.id ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 1) {
                    $condition .= '
                    ORDER BY address ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 3) {
                    $condition .= '
                    ORDER BY price ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 4) {
                    $condition .= '
                    ORDER BY quantity ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 5) {
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
                $sub_array[] = $row['address'];
                $sub_array[] = '<img src="' . _WEB_ROOT . '/upload/tour/' . $row["image"] . '" class="img-thumbnail" width="75">';
                $sub_array[] = $row["price"]."$";
                $sub_array[] = $row["quantity"];
                $sub_array[] = $row["status"];
                $sub_array[] = $row["date"];
                $sub_array[] = date('h:i a', strtotime($row["time"]))." - ". date('h:i a', strtotime($row["time_to"]));
                $sub_array[] = $row["description"];
                if ($_SESSION["role"] == "ROLE_ADMIN") {
                    $sub_array[] = '<button type="button" name="view_ticket" class="btn btn-info btn-sm view_ticket" id="' . $row["id"] . '">View</button>';
                    $sub_array[] = '<button type="button" name="edit_ticket" class="btn btn-primary btn-sm edit_ticket" id="' . $row["id"] . '">Edit</button>';
                    $sub_array[] = '<button type="button" name="delete_ticket" class="btn btn-danger btn-sm delete_ticket" id="' . $row["id"] . '">Delete</button>';
                } else {
                    $sub_array[] = '<button type="button" name="view_ticket" class="btn btn-info btn-sm view_ticket" id="' . $row["id"] . '">View</button>';
                $sub_array[] = '<button type="button" name="edit_ticket" class="btn btn-primary btn-sm edit_ticket" id="' . $row["id"] . '" disabled>Edit</button>';
                $sub_array[] = '<button type="button" name="delete_ticket" class="btn btn-danger btn-sm delete_ticket" id="' . $row["id"] . '" disabled>Delete</button>';
                }
                
                $data1[] = $sub_array;
            }
            $output = array(
                "draw"                =>    intval($_POST["draw"]),
                "recordsTotal"        =>    $filtered_rows,
                "recordsFiltered"     =>     count($this->model_tour->getListModel()),
                "data"                =>    $data1
            );
            // print_r($_POST);
            echo json_encode($output);
        }
    }

    public function detail($id) {
        if ($_POST['action'] == "single_fetch") {
            $dataDetail  = $this->model_tour->getListModel("INNER JOIN ticket ON ticket.tour_id = tour.id WHERE ticket.id = ".$id);
            $output = [];
            foreach ($dataDetail as $row) {
                $output['ticket_image'] = "upload/tour/".$row['image'];
                $output['ticket_address'] = $row['address'];
                $output['ticket_date'] = $row['date'];
                $output['ticket_price'] = $row['price'];
                $output['ticket_price'] = $row['price'];
                $output['ticket_time'] = substr_replace($row["time"],"",5);
                $output['ticket_time_to'] = substr_replace($row["time_to"],"",5);
            }
            echo json_encode($output);
        }
    }
}
