<?php
class OrderManage extends Controller
{
    public $data = [];
    public $model_order;
    public $model_user;
    public $model_ticket;
    public $file;
    public function __construct()
    {
        if($_SESSION['role'] == "ROLE_ADMIN" || $_SESSION['role'] == "ROLE_MEMBER" && isset($_SESSION['id'])) {
            $this->file = new FileUpload();
            $this->model_order = $this->model('OrderModel');
            $this->model_user = $this->model('UserModel');
            $this->model_ticket = $this->model('TicketModel');
        } else {
            Header("Location: "._WEB_ROOT."/home");
        }
       
    }

    public function index()
    {
        $this->render('admin/order');
    }

    public function update($id) {
        if (!isset($_POST['action']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            die;
        }
        if ($_POST['action'] == "Edit") {    
            $error = 0;

            $order_price = "";
            $error_order_price = "";
            if (empty($_POST["order_price"])) {
                $error_order_price = 'Giá tiền bắt buộc';
                $error++;
            } else {
                if (!intval($_POST['order_price'])) {
                    $error_order_price = 'Giá tiền không đúng định dạng';
                    $error++;
                } else {
                    $order_price = $_POST["order_price"];
                }
            }

            $order_time = "";
            $error_order_time = "";
                   
            if (empty($_POST['order_time'])) {
                $error_order_time = "Thời gian bắt đầu bắt buộc";
                $error++;
            } else {
                $order_time = $_POST['order_time'];
            }
            $order_time_to = "";
            $error_order_time_to = "";
                   
            if (empty($_POST['order_time'])) {
                $error_order_time_to = "Thời gian kết thúc bắt buộc";
                $error++;
            } else {
                $order_time_to = $_POST['order_time_to'];
            }
            
            
            if ($error > 0) {
                $output = array(
                    'error'                         =>    true,
                    'error_order_time'             =>    $error_order_time,
                    'error_order_time_to'          =>     $error_order_time_to,
                    'error_order_price'            =>    $error_order_price
                );
            } else {
                $data = array(
                    'time' => $order_time,
                    'time_to' => $order_time_to,
                    'price' => $order_price,
                );
                if ($this->model_order->updateModel($id,$data)) {
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

    public function list() 
    {
        if ($_POST['action'] == 'fetch') {
            $condition = "INNER JOIN order_table ON user.id = order_table.user_id ";
            if (!empty($_POST["search"]["value"])) {
                $condition .= 'WHERE order_table.address LIKE "%' . $_POST["search"]["value"] . '%" OR order_table.order_date LIKE "%' . $_POST["search"]["value"] . '%" OR user.email LIKE "%' . $_POST["search"]["value"] . '%" ';
            }
            if (isset($_POST["order"])) {
                $column = $_POST['order']['0']['column'];
                if ($column == "0") {
                    $condition .= '
                    ORDER BY order_table.id ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 1) {
                    $condition .= '
                    ORDER BY address' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 2) {
                    $condition .= '
                    ORDER BY order_date ' . $_POST['order']['0']['dir'] . '
                    ';
                } elseif ($column == 4) {
                    $condition .= '
                    ORDER BY total_price ' . $_POST['order']['0']['dir'] . '
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
                $sub_array[] = $row['address'];
                $sub_array[] = $row["order_date"];
                $sub_array[] = $row['email'];
                $sub_array[] = $row["total_price"]."$";
                $sub_array[] = $row["status"] ? "Đã thanh toán" : "Chưa thanh toán";
                $sub_array[] = '<button type="button" name="view_order" class="btn btn-info btn-sm view_order" id="' . $row["id"] . '">View</button>';
                $data1[] = $sub_array;
            }
            $output = array(
                "draw"                =>    intval($_POST["draw"]),
                "recordsTotal"        =>    $filtered_rows,
                "recordsFiltered"    =>     count($this->model_order->getListModel()),
                "data"                =>    $data1
            );
            echo json_encode($output);
        }
    }

    public function detail($id) {
        if ($_POST['action'] == "single_fetch") {
            $dataDetail  = $this->model_order->getListModel("INNER JOIN order_line ON order_table.id = order_line.order_id WHERE order_line.order_id = ".$id);
            $output = "<tr><th>Mã vé</th><th>Giá vé</th><th>Số lượng</th><th>Tổng tiền</th></tr>";
            foreach ($dataDetail as $row) {   
                $output .= '<tr>
                        <td>'.$row['ticket_id'].'</td>
                        <td>'.$row['price'].'$</td>
                        <td>'.$row['quantity'].'</td>
                        <td>'.$row['quantity']*$row['price'].'$</td>
                    </tr>';
            }
            echo $output;
        }
    }
}
