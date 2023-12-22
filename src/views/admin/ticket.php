<?php
    include("include/header.php")
?>
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9 font-weight-bold">DANH SÁCH VÉ</div>
                 <div class="col-md-3" align="right">
                    <button type="button" id="add_button" class="btn btn-success btn-sm">Thêm vé</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <span id="message_operation"></span>
                <table class="table table-striped table-bordered" id="table_ticket">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Địa chỉ tour</th>
                            <th>Ảnh Tour</th>
                            <th>Giá vé</th>
                            <th>Tình trạng</th>
                            <th>Ngày</th>
                            <th>Miêu tả</th>
                            <th>Xem</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
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

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="add_ticket_form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">
                        </h>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tour" class="col-form-label">Tour<span class="text-danger">*</span></label>
                        <select class="form-control" id="ticket_tour" name="ticket_tour">
                            <option value="">Select Tour</option>
                        </select>
                        <span id="error_ticket_tour" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="col-form-label">Giá($)<span class="text-danger">*</span></label>
                        <input id="ticket_price" type="number" name="ticket_price" class="form-control" required>
                        <span id="error_ticket_price" class="text-danger"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" id="action" value="">
                    <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="edit_ticket_form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title_edit">
                        </h>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                   
                    <div class="mb-3">
                        <label for="price" class="col-form-label">Giá/Vé ($)<span class="text-danger">*</span></label>
                        <input id="ticket_price_edit" type="number" name="ticket_price" class="form-control" required>
                        <span id="error_ticket_price_edit" class="text-danger"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="ticket_id" value="" />
                    <input type="hidden" name="action" id="action_edit" value="">
                    <input type="submit" name="button_action" id="button_action_edit" class="btn btn-success btn-sm" value="">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="viewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Thông tin vé</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="ticket_details">
                <div class="row">
                    <div class="col-md-3">
                        <img id="image" src="" class="img-thumbnail">

                    </div>
                    <div class="col-md-9">
                        <table class="table">
                            <tr>
                                <th>Địa chỉ</th>
                                <td id="address"></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td id="date"></td>
                            </tr>
                            <tr>
                                <th>Miêu tả</th>
                                <td id="description"></td>
                            </tr>
                            <tr>
                                <th>Giá</th>
                                <td id="price"></td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <td id="time_ticket"></td>
                            </tr>
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
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title"><span class="text-danger">Xóa người dùng</span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h3 align="center">Bạn có chắc chắn xóa người dùng?</h3>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="confirm_button" class="btn btn-primary btn-sm">Confirm</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#table_ticket').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= _WEB_ROOT ?>/ticketManage/list",
                type: "POST",
                data: {
                    action: 'fetch'
                }
            },
            "columnDefs": [{
                "targets": [2, 6,7,8,9],
                "orderable": false,
            }, ],
        });

        function clear_field() {
            $('#add_ticket_form')[0].reset();
            $('#error_ticket_tour').text('');          
            $('#error_ticket_price').text('');
        }
        $('#add_button').click(function() {
            $('#modal_title').text("Thêm vé");
            $('#button_action').val('Thêm vé');
            $('#action').val('Add');
            $('#myModal').modal('show');
            $.ajax({
                url: "<?= _WEB_ROOT ?>/ticketManage/create",
                method: "POST",
                data: {action : 'tour_list'},
                success: function (html) {
                    $('#ticket_tour').html(html);
                }
            });
            clear_field();
        });
        $('#add_ticket_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= _WEB_ROOT ?>/ticketManage/create",
                method: "POST",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#button_action').val('Validate...');
                    $('#button_action').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#button_action').attr('disabled', false);
                    $('#button_action').val("Thêm người vé");
                    if (data.success) {
                        $('#message_operation').html('<div class="alert alert-success">' + data.success + '</div>');
                        $('#myModal').modal('hide');
                        table.ajax.reload();
                    }
                    if (data.error) {
                        if (data.error_ticket_price != '') {
                            $('#error_ticket_price').text(data.error_ticket_price);
                        } else {
                            $('#error_ticket_price').text('');
                        }
                        if (data.error_ticket_tour != '') {
                            $('#error_ticket_tour').text(data.error_ticket_tour);
                        } else {
                            $('#error_ticket_tour').text('');
                        }
                    }
                }
            });

        });
        var ticket_id = '';
        $(document).on('click', '.view_ticket', function() {
            ticket_id = $(this).attr('id');
            $("#message_operation").text("");
            $.ajax({
                url: "<?= _WEB_ROOT ?>/ticketManage/detail/".concat("", ticket_id),
                method: "POST",
                dataType: "json",
                data: {
                    action: 'single_fetch',
                },
                success: function(data) {
                    $('#image').attr("src", data.ticket_image);
                    $('#date').text(data.ticket_date);
                    $('#address').text(data.ticket_address);
                    $('#description').text(data.ticket_description);
                    $('#price').text(data.ticket_price + "$");
                    $('#time_ticket').text(data.ticket_time + " - " + data.ticket_time_to);
                    $('#viewModal').modal('show');
                }
            });
        });
        $(document).on('click', '.edit_ticket', function() {
            ticket_id = $(this).attr('id');
            $('#modal_title_edit').text("Thay đổi thông tin vé");
            $('#button_action_edit').val('Thay đổi');
            $('#ticket_id').val(ticket_id);
            $('#action_edit').val('Edit');
            $("#message_operation").text("");
            $.ajax({
                url: "<?= _WEB_ROOT ?>/ticketManage/detail/".concat("", ticket_id),
                method: "POST",
                data: {
                    action: 'single_fetch'
                },
                dataType: "json",
                success: function(data) {
                    $('#ticket_time_edit').val(data.ticket_time);
                    $('#ticket_time_to_edit').val(data.ticket_time_to);
                    $('#ticket_price_edit').val(data.ticket_price);
                    $('#action_edit').val('Edit');
                    $('#editModal').modal('show');
                }
            });
            clear_field_edit();
        });
        $('#edit_ticket_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= _WEB_ROOT ?>/ticketManage/update/".concat("",$('#ticket_id').val()),
                method: "POST",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#button_action_edit').val('Validate...');
                    $('#button_action_edit').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#button_action_edit').attr('disabled', false);
                    $('#button_action_edit').val("Thay đổi");
                    if (data.success) {
                        $('#message_operation').html('<div class="alert alert-success">' + data.success + '</div>');
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                    }
                    if (data.error) {
                        if (data.error_ticket_price != '') {
                            $('#error_ticket_price_edit').text(data.error_ticket_price);
                        } else {
                            $('#error_ticket_price_edit').text('');
                        }
                    }
                }
            });

        });
        $(document).on('click', '.delete_ticket', function() {
            ticket_id = $(this).attr('id');
            $('#deleteModal').modal('show');
            $('#confirm_button').click(function() {
                $.ajax({
                    url: "<?= _WEB_ROOT ?>/ticketManage/delete/".concat("", ticket_id),
                    method: "POST",
                    data: {action: "delete"},
                    success: function(data) {
                        $('#message_operation').html('<div class="alert alert-success">' + data + '</div>');
                        $('#deleteModal').modal('hide');
                        table.ajax.reload();
                    }
                })
            });
        });
        
    });
</script>