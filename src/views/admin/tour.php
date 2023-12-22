<?php
    include("include/header.php")
?>
<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9 font-weight-bold">DANH SÁCH VÉ</div>
                <?php if($_SESSION['role'] == "ROLE_ADMIN") {
                    ?>
                 <div class="col-md-3" align="right">
                    <button type="button" id="add_button" class="btn btn-success btn-sm">Thêm tour</button>
                </div>
                <?php
                }
                    ?>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <span id="message_operation"></span>
                <table class="table table-striped table-bordered" id="table_tour">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th>Ảnh</th>
                            <th>Địa chỉ</th>
                            <th>Ngày</th>
                            <th>Thời gian diễn ra</th>
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
            <form method="POST" id="add_tour_form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title">
                        </h>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="col-form-label">Ngày diễn ra<span class="text-danger">*</span></label>
                        <input id="tour_date" type="date" name="tour_date" class="form-control" required>
                        <span id="error_tour_date" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="col-form-label">Thời gian bắt đầu<span class="text-danger">*</span></label>
                        <input id="tour_time" type="time" name="tour_time" class="form-control" required>
                        <span id="error_tour_time" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="time_to" class="col-form-label">Thời gian kết thúc<span class="text-danger">*</span></label>
                        <input id="tour_time_to" type="time" name="tour_time_to" lang="en" class="form-control" required>
                        <span id="error_tour_time_to" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="col-form-label">Địa chỉ<span class="text-danger">*</span></label>
                        <textarea id="tour_address" type="text" name="tour_address" class="form-control" required></textarea>
                        <span id="error_tour_address" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="col-form-label">Miêu tả<span class="text-danger">*</span></label>
                        <textarea id="tour_description" type="text" name="tour_description" class="form-control" required></textarea>
                        <span id="error_tour_description" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="col-form-label">Ảnh<span class="text-danger">*</span></label>
                        <input type="file" name="tour_image" id="tour_image" required><br>
                        <span class="text-muted">Chỉ cho phép .jpg và .png</span><br>
                        <span id="error_tour_image" class="text-danger"></span>
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
            <form method="POST" id="edit_tour_form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title_edit">
                        </h>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="col-form-label">Ngày diễn ra<span class="text-danger">*</span></label>
                        <input id="tour_date_edit" type="date" name="tour_date" class="form-control" required>
                        <span id="error_tour_date" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="col-form-label">Thời gian bắt đầu<span class="text-danger">*</span></label>
                        <input id="tour_time_edit" type="time" name="tour_time" class="form-control" required>
                        <span id="error_tour_time_edit" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="time_to" class="col-form-label">Thời gian kết thúc<span class="text-danger">*</span></label>
                        <input id="tour_time_to_edit" type="time" name="tour_time_to" lang="en" class="form-control" required>
                        <span id="error_tour_time_to_edit" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="col-form-label">Địa chỉ<span class="text-danger">*</span></label>
                        <textarea id="tour_address_edit" type="text" name="tour_address" class="form-control" required></textarea>
                        <span id="error_tour_address" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="col-form-label">Miêu tả<span class="text-danger">*</span></label>
                        <textarea id="tour_description_edit" type="text" name="tour_description" class="form-control" required></textarea>
                        <span id="error_tour_description" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="col-form-label">Ảnh<span class="text-danger">*</span></label>
                        <input type="file" name="tour_image" id="tour_image_edit"><br>
                        <span class="text-muted">Chỉ cho phép .jpg và .png</span><br>
                        <span id="error_tour_image_edit" class="text-danger"></span>
                        <span id="tour_image_current"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="tour_id" value="" />
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
                <h4 class="modal-title">Thông tin tour</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="tour_details">
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
                                <th>Ngày diễn ra</th>
                                <td id="date"></td>
                            </tr>
                            <tr>
                                <th>Thời gian diễn ra</th>
                                <td id="time_tour"></td>
                            </tr>
                            <tr>
                                <th>Miêu tả</th>
                                <td id="description"></td>
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
                <h4 class="modal-title"><span class="text-danger">Xóa Tour diễn</span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <h3 align="center">Bạn có chắc chắn xóa Tour diễn?</h3>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="confirm_button" class="btn btn-primary btn-sm">Xác nhận</button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#table_tour').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "<?= _WEB_ROOT ?>/tourManage/list",
                type: "POST",
                data: {
                    action: 'fetch'
                }
            },
            "columnDefs": [{
                "targets": [1,4,5,6,7,8],
                "orderable": false,
            }, ],
        });

        function clear_field() {
            $('#add_tour_form')[0].reset();
            $('#error_tour_date').text('');
            $('#error_tour_description').text('');
            $('#error_tour_address').text('');
            $('#error_tour_image').text('');
        }
        $('#add_button').click(function() {
            $('#modal_title').text("Thêm vé");
            $('#button_action').val('Thêm vé');
            $('#action').val('Add');
            $('#myModal').modal('show');

            clear_field();
        });
        $('#add_tour_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= _WEB_ROOT ?>/tourManage/create",
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
                    $('#button_action').val("Thêm tour diễn");
                    if (data.success) {
                        $('#message_operation').html('<div class="alert alert-success">' + data.success + '</div>');
                        $('#myModal').modal('hide');
                        table.ajax.reload();
                    }
                    if (data.error) {
                        if (data.error_tour_address != '') {
                            $('#error_tour_address').text(data.error_tour_address);
                        } else {
                            $('#error_tour_address').text('');
                        }
                        if (data.error_tour_description != '') {
                            $('#error_tour_description').text(data.error_tour_description);
                        } else {
                            $('#error_tour_description').text('');
                        }
                        if (data.error_tour_date != '') {
                            $('#error_tour_date').text(data.error_tour_date);
                        } else {
                            $('#error_tour_date').text('');
                        }
                        if (data.error_tour_image != '') {
                            $('#error_tour_image').text(data.error_tour_image);
                        } else {
                            $('#error_tour_image').text('');
                        }
                    }
                }
            });

        });
        var tour_id = '';
        function clear_field_edit() {
            $('#edit_tour_form')[0].reset();
            $('#error_tour_date_edit').text('');
            $('#error_tour_description_edit').text('');
            $('#error_tour_address_edit').text('');
            $('#error_tour_image_edit').text('');
            $('#error_tour_time_edit').text('');
            $('#error_tour_time_to_edit').text('');
        }
        $(document).on('click', '.view_tour', function() {
            tour_id = $(this).attr('id');
            $("#message_operation").text("");
            $.ajax({
                url: "<?= _WEB_ROOT ?>/tourManage/detail/".concat("", tour_id),
                method: "POST",
                dataType: "json",
                data: {
                    action: 'single_fetch',
                },
                success: function(data) {
                    $('#image').attr("src", data.tour_image);
                    $('#date').text(data.tour_date);
                    $('#description').text(data.tour_description);
                    $('#address').text(data.tour_address);
                    $('#time_tour').text(data.tour_time + " - " + data.tour_time_to);
                    $('#viewModal').modal('show');
                }
            });
        });
        $(document).on('click', '.edit_tour', function() {
            tour_id = $(this).attr('id');
            $('#modal_title_edit').text("Thay đổi thông tin Tour");
            $('#button_action_edit').val('Thay đổi');
            $('#tour_id').val(tour_id);
            $('#action_edit').val('Edit');
            $("#message_operation").text("");
            $.ajax({
                url: "<?= _WEB_ROOT ?>/tourManage/detail/".concat("", tour_id),
                method: "POST",
                data: {
                    action: 'single_fetch'
                },
                dataType: "json",
                success: function(data) {
                    $('#tour_date_edit').val(data.tour_date);
                    $('#tour_description_edit').val(data.tour_description);
                    $('#tour_address_edit').val(data.tour_address);
                    $('#tour_time_edit').val(data.tour_time);
                    $('#tour_time_to_edit').val(data.tour_time_to);
                    $('#tour_image_current').html('<img src="' + data.tour_image + '" class="img-thumbnail" width="50" />');
                    $('#action_edit').val('Edit');
                    $('#editModal').modal('show');
                }
            });
            clear_field_edit();
        });
        $('#edit_tour_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= _WEB_ROOT ?>/tourManage/update/".concat("",$('#tour_id').val()),
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
                        if (data.error_tour_date != '') {
                            $('#error_tour_date_edit').text(data.error_tour_date);
                        } else {
                            $('#error_tour_date_edit').text('');
                        }
                        if (data.error_tour_address != '') {
                            $('#error_tour_address_edit').text(data.error_tour_address);
                        } else {
                            $('#error_tour_address_edit').text('');
                        }
                        if (data.error_tour_description != '') {
                            $('#error_tour_description_edit').text(data.error_tour_description);
                        } else {
                            $('#error_tour_description_edit').text('');
                        }
                        if (data.error_tour_image != '') {
                            $('#error_tour_image_edit').text(data.error_tour_image);
                        } else {
                            $('#error_tour_image_edit').text('');
                        }
                        if (data.error_tour_time != '') {
                            $('#error_tour_time_edit').text(data.error_tour_time);
                        } else {
                            $('#error_tour_time_edit').text('');
                        }
                        if (data.error_tour_time_to != '') {
                            $('#error_tour_time_to_edit').text(data.error_tour_time_to);
                        } else {
                            $('#error_tour_time_to_edit').text('');
                        }
                    }
                }
            });

        });
        $(document).on('click', '.delete_tour', function() {
            tour_id = $(this).attr('id');
            $('#deleteModal').modal('show');
            $('#confirm_button').click(function() {
                $.ajax({
                    url: "<?= _WEB_ROOT ?>/tourManage/delete/".concat("", tour_id),
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