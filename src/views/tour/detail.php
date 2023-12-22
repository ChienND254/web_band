<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vé Ca Nhạc</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Custom styles go here */
        .event-details {
            padding: 20px;
        }

        .event-image {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <!-- Bên trái: Ảnh của nơi diễn ra -->
            <div class="col-md-6">
                <img src="path/to/event-image.jpg" alt="Nơi diễn ra" class="event-image">
            </div>

            <!-- Bên phải: Thông tin vé -->
            <div class="col-md-6">
                <div class="event-details">
                    <h2><?php echo $tour_detail['address'] ?></h2>
                    <p><?php echo $tour_detail['date'] ?></p>
                    <p><?php echo $tour_detail['description'] ?></p>

                    <!-- Nút tăng giảm số lượng vé -->
                    <div class="form-group">
                        <label for="ticketQuantity">Số lượng vé:</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="ticketQuantity">
                                    <span class="glyphicon glyphicon-minus">-</span>
                                </button>
                            </span>
                            <input type="text" name="ticketQuantity" class="form-control input-number" value="1" min="1" max="10">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="ticketQuantity">
                                    <span class="glyphicon glyphicon-plus">+</span>
                                </button>
                            </span>
                        </div>
                    </div>

                    <!-- Hiển thị số vé còn lại trong kho -->
                    <p>Số vé còn lại: 100</p>

                    <!-- Nút giỏ hàng và thanh toán -->
                    <button type="button" class="btn btn-primary">Thêm vào giỏ hàng</button>
                    <button type="button" class="btn btn-success">Thanh toán</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Link to Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript for number input -->
    <script>
        $(document).ready(function() {
            $('.btn-number').click(function(e) {
                e.preventDefault();

                var fieldName = $(this).attr('data-field');
                var type = $(this).attr('data-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {
                        input.val(currentVal > 1 ? currentVal - 1 : 1);
                    } else if (type == 'plus') {
                        input.val(currentVal < 10 ? currentVal + 1 : 10);
                    }
                } else {
                    input.val(1);
                }
            });
        });
    </script>

</body>

</html>