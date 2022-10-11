<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GotoGro_MRM_Sales</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            width: 100%;
            background: #fff;
            margin: 0 auto;
            padding: 20px 30px 5px;
            box-shadow: 0 0 1px 0 rgba(0, 0, 0, .25);
            overflow: hidden;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            min-width: 130px;
            border-radius: 2px;
            border: none;
            padding: 6px 12px;
            font-size: 95%;
            outline: none !important;
            height: 30px;
        }

        .table-title {
            min-width: 100%;
            border-bottom: 1px solid #e9e9e9;
            padding-bottom: 15px;
            margin-bottom: 5px;
            background: rgb(0, 50, 74);
            margin: -20px -31px 10px;
            padding: 15px 30px;
            color: #fff;
        }

        .table-title h2 {
            margin: 2px 0 0;
            font-size: 24px;
        }

        table.table {
            min-width: 100%;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 50px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table td a {
            color: #2196f3;
        }

        table.table td .btn.manage {
            padding: 2px 10px;
            background: #37BC9B;
            color: #fff;
            border-radius: 2px;
        }

        table.table td .btn.manage:hover {
            background: #2e9c81;
        }

        .col-sm-4 {
            margin-left: 720px;
        }

        .search-box {
            position: relative;
            float: right;
        }

        .search-box input {
            height: 34px;
            border-radius: 20px;
            padding-left: 35px;
            border-color: #ddd;
            box-shadow: none;
        }

        .search-box input:focus {
            border-color: #3FBAE4;
        }

        .search-box i {
            color: #a0a5b1;
            position: absolute;
            font-size: 19px;
            top: 8px;
            left: 10px;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
            font-size: 14px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }

        .avoid-clicks {
            pointer-events: none;
        }

        .cursor-not-allowed {
            cursor: not-allowed;
        }
    </style>
    <script>
        $(document).ready(function() {
            $(".btn-group .btn").click(function() {
                var inputValue = $(this).find("input").val();
                if (inputValue != 'all') {
                    var target = $('table tr[data-status="' + inputValue + '"]');
                    $("table tbody tr").not(target).hide();
                    target.fadeIn();
                } else {
                    $("table tbody tr").fadeIn();
                }
            });
            // Changing the class of status label to support Bootstrap 4
            var bs = $.fn.tooltip.Constructor.VERSION;
            var str = bs.split(".");
            if (str[0] == 4) {
                $(".label").each(function() {
                    var classStr = $(this).attr("class");
                    var newClassStr = classStr.replace(/label/g, "badge");
                    $(this).removeAttr("class").addClass(newClassStr);
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function() {
                if (this.checked) {
                    checkbox.each(function() {
                        this.checked = true;
                    });
                } else {
                    checkbox.each(function() {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function() {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        });
    </script>

    <script>
        //Search bar
        $(document).ready(function() {
            $("#search_input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</head>

<body>
    <!-------NAV---->
    <?php include 'sidebar.php'; ?>
    <?php
    if($getuser->emp_position >= 0 && $getuser->emp_position != 2){
        // do nothing
    }
    else{
        echo alert("You do not have sufficient permissions to access this page.");
        echo redirect("login.php");
    }

    if (isset($_POST["go_update"])) {
        tep_query("UPDATE orders SET
        shipment_date = '" . $_POST["shipment_date"] . "',
        order_status = '" . $_POST["order_status"] . "',
        emp_id = '" . $_POST["emp_id"] . "'
        WHERE order_id = '" . $_POST["order_id"] . "'
        ");
        echo redirect("sales.php?update=success");
    }
    ?>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Sales <b>Records</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-info active">
                                    <input type="radio" name="status" value="all" checked="checked"> All
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="status" value="completed"> Completed
                                </label>
                                <label class="btn btn-warning">
                                    <input type="radio" name="status" value="pending"> Pending
                                </label>
                                <label class="btn btn-danger">
                                    <input type="radio" name="status" value="cancel"> Cancelled
                                </label>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" id="search_input" placeholder="Search&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <a href="#add_order" class="btn btn-info" data-toggle="modal"> <span>Add Order</span></a>
                </div>
                <br>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Member Email</th>
                            <th>Item</th>
                            <th>Amount</th>
                            <th>Receipt</th>
                            <th>Order Placed</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        $cnt = 0;

                        $qryRow = tep_query("SELECT * FROM orders ORDER BY order_id DESC");
                        while ($infoRow = tep_fetch_object($qryRow)) {
                            $cnt++;
                            $customer = tep_fetch_object(tep_query("SELECT * FROM customer WHERE customer_id = '" . $infoRow->customer_id . "'"));
                            $item_idListArr = explode(';', $infoRow->item_idList);

                            $status = $infoRow->order_status;

                            if ($status == 2) {
                                echo '<tr data-status="completed">';
                            }
                            if ($status == 1) {
                                echo '<tr data-status="done">';
                            }
                            if ($status == 0) {
                                echo '<tr data-status="pending">';
                            }
                            if ($status == -1) {
                                echo '<tr data-status="cancel">';
                            }
                            echo '
                            <td>' . $cnt . '</td>
                            <td><a href="#customer_info" class="get_customer" data-toggle="modal"
                            data-id="' . $customer->customer_id . '"
                            data-name="' . $customer->customer_name . '"
                            data-email="' . $customer->customer_email . '"
                            data-contact="' . $customer->customer_contact . '"
                            data-address="' . $customer->customer_address . '"
                            data-status="' . $customer->customer_status . '"
                            >' . $customer->customer_email . '</a></td>
                            <td><ol>';
                            $cnt2 = 0;
                            foreach ($item_idListArr as $id) {
                                if ($id == null) {
                                    continue;
                                }
                                $cart_item = tep_fetch_object(tep_query("SELECT * FROM cart_items WHERE item_id = '" . $id . "'"));
                                $product = tep_fetch_object(tep_query("SELECT * FROM products WHERE product_id = '" . $cart_item->product_id . "'"));

                            }
                            echo '
                            </ol></td>
                            <td>RM ' . $infoRow->order_totalPrice . '</td>
                            <td><a href="#"><img src="../../images/' . $infoRow->order_receipt . '" style="width:40px;height:40px"></a></td>
                            <td>' . $infoRow->order_dateCreated . '</td>
                            <td>';
                            if ($status == 2) {
                                echo '<span class="badge badge-primary">Completed</span>';
                            }
                            if ($status == 1) {
                                echo '<span class="badge badge-success">Delivered</span>';
                            }
                            if ($status == 0) {
                                echo '<span class="badge badge-warning">Pending</span>';
                            }
                            if ($status == -1) {
                                echo '<span class="badge badge-danger">Cancelled</span>';
                            }
                            echo '
                            </td>
                            <td><a href="#edit_order" class="btn btn-sm manage get_details" data-toggle="modal"
                            data-id = "' . $infoRow->order_id . '"
                            data-pref_date = "' . $infoRow->preffered_date . '"
                            data-pref_time = "' . $infoRow->preffered_time . '"
                            data-method = "' . $infoRow->order_pickupMethod . '"
                            data-ship_date = "' . $infoRow->shipment_date . '"
                            data-status = "' . $infoRow->order_status . '"
                            data-emp_id = "' . $infoRow->emp_id . '"
                            >D&M</a></td>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="add_order" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Sales ID</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Member ID</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Order Placed</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Item</label>
                            <textarea class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>QTY</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Delivery Status</label>
                            <br>
                            <select name="delivey" id="delivey" style="width:335px;height:40px">
                                <option value="deliverd">Completed</option>
                                <option value="deliverd">Delivered</option>
                                <option value="pending">Pending</option>
                                <option value="canceled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Order HTML -->
    <div id="edit_order" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Manage Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="get_id" name="order_id">
                            <label>Preffered Date</label>
                            <div class="cursor-not-allowed">
                                <input type="text" class="form-control avoid-clicks get_pref_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Preffered Time</label>
                            <div class="cursor-not-allowed">
                                <input type="text" class="form-control avoid-clicks get_pref_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Method</label>
                            <br>
                            <div class="cursor-not-allowed">
                                <select class="get_method avoid-clicks" style="width:335px;height:40px">
                                    <option value="1">Delivery</option>
                                    <option value="0">Pick Up</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Shipment Date</label>
                            <div class="cursor-not-allowed">
                                <input type="text" class="form-control get_ship_date avoid-clicks">
                            </div>
                            <input type="date" class="form-control" name="shipment_date">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <br>
                            <select class="get_status" style="width:335px;height:40px" name="order_status">
                                <option value="2">Completed</option>
                                <option value="1">Delivered</option>
                                <option value="0">Pending</option>
                                <option value="-1">Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ID of the staff responsible for the delivery: </label>
                            <input type="number" class="form-control get_emp_id" name="emp_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" name="go_update" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Customer Info Modal -->
    <div id="customer_info" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Member Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Member ID</label>
                        <input type="text" class="form-control get_id">
                    </div>
                    <div class="form-group">
                        <label>Member Name</label>
                        <input type="text" class="form-control get_name">
                    </div>
                    <div class="form-group">
                        <label>Member Email</label>
                        <input type="text" class="form-control get_email">
                    </div>
                    <div class="form-group">
                        <label>Member Contact</label>
                        <input type="text" class="form-control get_contact">
                    </div>
                    <div class="form-group">
                        <label>Member Address</label>
                        <input type="text" class="form-control get_address">
                    </div>
                    <div class="form-group">
                        <label>Member Status</label>
                        <br>
                        <select class="get_status" style="width:335px;height:40px">
                            <option value="1">Active</option>
                            <option value="0">Inactivated</option>
                            <option value="-1">Banned</option>
                            <option value="-2">Deactived</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
                </div>
            </div>
        </div>
    </div>
    <script>
        // update Modal
        $(document).ready(function() {
            $(document).on('click', '.get_details', function(e) {

                var get_id = $(this).attr("data-id");
                var get_pref_date = $(this).attr("data-pref_date");
                var get_pref_time = $(this).attr("data-pref_time");
                var get_method = $(this).attr("data-method");
                var get_ship_date = $(this).attr("data-ship_date");
                var get_status = $(this).attr("data-status");
                var get_emp_id = $(this).attr("data-emp_id");

                $(".get_id").val(get_id);
                $(".get_pref_date").val(get_pref_date);
                $(".get_pref_time").val(get_pref_time);
                $(".get_method").val(get_method);
                $(".get_ship_date").val(get_ship_date);
                $(".get_status").val(get_status);
                $(".get_emp_id").val(get_emp_id);

            });
        });
        // Customer Info Modal
        $(document).ready(function() {
            $(document).on('click', '.get_customer', function(e) {

                var get_id = $(this).attr("data-id");
                var get_name = $(this).attr("data-name");
                var get_email = $(this).attr("data-email");
                var get_contact = $(this).attr("data-contact");
                var get_address = $(this).attr("data-address");
                var get_status = $(this).attr("data-status");

                $(".get_id").val(get_id);
                $(".get_name").val(get_name);
                $(".get_email").val(get_email);
                $(".get_contact").val(get_contact);
                $(".get_address").val(get_address);
                $(".get_status").val(get_status);

            });
        });
    </script>
</body>

</html>