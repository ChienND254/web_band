<?php
    include("include/header.php")
?>
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9 font-weight-bold">DANH SÁCH ĐƠN HÀNG</div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <span id="message_operation"></span>
                <table class="table table-striped table-bordered" id="table_order">
                    <thead>
                        <tr>
                            <th>Mã ID</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt</th>
                            <th>Email người đặt</th>
                            <th>Tổng đơn hàng</th>
                            <th>Tình trạng thanh toán</th>
                            <th>Chi tiết đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<div class="modal" id="viewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Thông tin vé</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="order_details">
                <div class="row">
                    <div class="col-md-9">
                        <table class="table" id="table_order_view">
                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#table_order').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= _WEB_ROOT ?>/orderManage/list",
                type: "POST",
                data: {
                    action: 'fetch'
                }
            },
            "columnDefs": [{
                "targets": [3,6],
                "orderable": false,
            }, ],
        });
        $(document).on('click', '.view_order', function() {
            order_id = $(this).attr('id');
            $("#message_operation").text("");
            $.ajax({
                url: "<?= _WEB_ROOT ?>/orderManage/detail/".concat("", order_id),
                method: "POST",
                data: {
                    action: 'single_fetch',
                },
                success: function(data) {
                    $('#table_order_view').html(data);
                    $('#viewModal').modal('show');
                }
            });
        }); 
    });
</script>