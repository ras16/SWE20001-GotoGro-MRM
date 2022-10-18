<?php include 'setup.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GotoGro_MRM_Sales</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
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

        .table-content {
            margin: 0px -30px 0px;
            padding: 20px 30px 5px;
            overflow: auto;
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

        .container-xl {
            padding-bottom: 10px;
        }

        .month-pickers {
            text-align: right;
        }

        .table-dropdown {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .table-dropdown.rotate {
            transform: rotate(-180deg);
        }
        
        .table-dropdown:not(.rotate) {
            transform: rotate(0deg);
        }
    </style>
    <script>
        $(document).ready(function() {
            let totalSalesSpan = $("#total_sales");
            function updateTotalSales() {
                let totalSales = 0;
                $("#myTable tr").each(function() {
                    if ($(this).is(":visible")) {
                        totalSales += parseInt($(this).attr("data-amount"));
                    }
                });
                totalSalesSpan.text(totalSales);
            }
            updateTotalSales();

            $("#filter-month").change(function() {
                let month = this.value === "" ? null : new Date(this.value);

                $("#myTable tr").each(function() {
                    let date = new Date($(this).attr("data-sales_dateCreated"));
                    $(this).toggle(month === null || date.getMonth() == month.getMonth());
                })

                updateTotalSales();
            })

            $(".btn-group .btn").click(function() {
                var inputValue = $(this).find("input").val();
                if (inputValue != 'all') {
                    var target = $('#myTable tr[data-status="' + inputValue + '"]');
                    $("#myTable tr").not(target).hide();
                    target.fadeIn();
                } else {
                    $("#myTable tr").fadeIn();
                }
                updateTotalSales();
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
            
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('#myTable input[type="checkbox"]');
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
            
            $("#search_input").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").each(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
                updateTotalSales();
            });

            let monthlySales = $("#monthly-sales-report tr");

            let afterDate = null;
            let beforeDate = null;
            function updateMonthlySales() {
                monthlySales.each(function() {
                    let date = new Date($(this).attr("data-sales_month"));
                    $(this).toggle((afterDate === null || date >= afterDate) && (beforeDate === null || date <= beforeDate));
                });
            }

            $("#after-month").change(function() {
                afterDate = this.value === "" ? null : new Date(this.value);
                updateMonthlySales();
            });

            $("#before-month").change(function() {
                beforeDate = this.value === "" ? null : new Date(this.value);
                updateMonthlySales();
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
        exit;
    }

    if (isset($_POST["add_new"])) {
        $file = $_FILES["sales_receipt"];

        $fileName = $file["name"];
        $fileTmpName = $file["tmp_name"];
        $fileSize = $file["size"];
        $fileError = $file["error"];
        $fileType = $file["type"];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array("jpg", "jpeg", "png");

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = "images/" . $fileNameNew;
                    // START - Upload 
                    move_uploaded_file($fileTmpName, $fileDestination);
                    tep_query("INSERT INTO sales(
                        inv_id,
                        sales_qty,
                        sales_receipt,
                        sales_status,
                        sales_dateCreated,
                        member_id,
                        emp_id
                    )VALUES(
                        '" . $_POST["inv_id"] . "',
                        '" . $_POST["sales_qty"] . "',
                        '" . $fileNameNew . "',
                        '" . $_POST["sales_status"] . "',
                        '" . $_POST["sales_dateCreated"] . "',
                        '" . $_POST["member_id"] . "',
                        '" . $getuser->emp_id . "'
                    );");
                    echo redirect("sales.php?add_new=success");
                } else {
                    echo alert("Your file is too big.");
                }
            } else {
                echo alert("There was an error uploading your file.");
            }
        } else {
            echo alert("You cannot upload files of this type.");
        }
    } else if (isset($_POST["go_modify"])) {
        $file = $_FILES["sales_receipt"];

        if ($file['size'] == 0) {
            tep_query("UPDATE sales SET
            sales_qty = '" . $_POST["sales_qty"] . "',
            sales_dateCreated = '" . $_POST["sales_dateCreated"] . "',
            sales_status = '" . $_POST["sales_status"] . "'
            WHERE sales_id = '" . $_POST["sales_id"] . "'
            ");
        } else {
            $fileName = $file["name"];
            $fileTmpName = $file["tmp_name"];
            $fileSize = $file["size"];
            $fileError = $file["error"];
            $fileType = $file["type"];

            $fileExt = explode(".", $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array("jpg", "jpeg", "png");

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 1000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = "images/" . $fileNameNew;
                        // START - Upload 
                        move_uploaded_file($fileTmpName, $fileDestination);
                        tep_query("UPDATE sales SET
                        sales_qty = '" . $_POST["sales_qty"] . "',
                        sales_receipt = '" . $fileNameNew . "',
                        sales_dateCreated = '" . $_POST["sales_dateCreated"] . "',
                        sales_status = '" . $_POST["sales_status"] . "'
                        WHERE sales_id = '" . $_POST["sales_id"] . "'
                        ");
                        echo redirect("sales.php?modify=success");
                    } else {
                        echo alert("Your file is too big.");
                    }
                } else {
                    echo alert("There was an error uploading your file.");
                }
            } else {
                echo alert("You cannot upload files of this type.");
            }
        }
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
                                <label class="btn btn-success">
                                    <input type="radio" name="status" value="done"> Delivered
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
                            <div class="float-right">
                                <label>Month:&nbsp;</label><input type="month" id="filter-month">
                            </div>
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" id="search_input" placeholder="Search&hellip;">
                            </div>
                        </div>
                        <div class="table-dropdown bx bxs-chevron-down arrow"></div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <a href="#add_sales" class="btn btn-info" data-toggle="modal"> <span>Add Sales</span></a>
                </div>
                <br>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Sales ID</th>
                            <th>Member Email</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Receipt</th>
                            <th>Sales Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        $qryRow = tep_query("SELECT * FROM sales ORDER BY sales_id");
                        while ($infoRow = tep_fetch_object($qryRow)) {
                            $member = tep_fetch_object(tep_query("SELECT * FROM members WHERE members_id = '" . $infoRow->member_id . "'"));
                            $inv = tep_fetch_object(tep_query("SELECT * FROM inventory WHERE inv_id = {$infoRow->inv_id}"));
                            
                            $amount = $infoRow->sales_qty * $inv->inv_price;
                            $status = $infoRow->sales_status;

                            echo '<tr data-status="';
                            switch ($status) {
                                case 2:
                                    echo 'completed';
                                    break;
                                case 1:
                                    echo 'done';
                                    break;
                                case 0:
                                    echo 'pending';
                                    break;
                                case -1:
                                    echo 'cancel';
                                    break;
                                default:
                                    break;
                            }
                            echo "\" data-amount=\"$amount\" data-sales_dateCreated=\"{$infoRow->sales_dateCreated}\">";
                            echo '
                            <td>' . $infoRow->sales_id . '</td>
                            <td><a href="#member_info" class="get_member" data-toggle="modal"
                            data-id="' . $member->members_id . '"
                            data-name="' . $member->members_name . '"
                            data-email="' . $member->members_email . '"
                            data-contact="' . $member->members_contact . '"
                            data-address="' . $member->members_address . '"
                            data-status="' . $member->members_status . '"
                            >' . $member->members_email . '</a></td>
                            <td>' . $inv->inv_title . '</td>
                            <td>' . $infoRow->sales_qty . '</td>
                            <td data-amount=' . $amount . '>RM ' . $amount . '</td>
                            <td><a href="#"><img src="images/' . $infoRow->sales_receipt . '" style="width:40px;height:40px"></a></td>
                            <td>' . $infoRow->sales_dateCreated . '</td>
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
                            <td><a href="#edit_sales" class="btn btn-sm manage get_details" data-toggle="modal"
                            data-sales_id = "' . $infoRow->sales_id . '"
                            data-inv_id = "' . $infoRow->inv_id . '"
                            data-sales_qty = "' . $infoRow->sales_qty . '"
                            data-sales_dateCreated = "' . $infoRow->sales_dateCreated . '"
                            data-sales_status = "' . $infoRow->sales_status . '"
                            data-member_id = "' . $infoRow->member_id . '"
                            >Edit</a></td>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
                <div class="col-sm-5">
                    Total Sales: <b>RM <span id="total_sales">0</span></b>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Add Modal HTML -->
    <div id="add_sales" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Sales</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Inventory ID</label>
                            <input type="text" class="form-control" name="inv_id" required>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="sales_qty" required>
                        </div>
                        <div class="form-group">
                            <label>Receipt</label>
                            <input type="file" class="form-control" name="sales_receipt" required>
                        </div>
                        <div class="form-group">
                            <label>Sales Status</label>
                            <br>
                            <select name="sales_status" style="width:335px;height:40px">
                                <option value="2">Completed</option>
                                <option value="1">Delivered</option>
                                <option value="0">Pending</option>
                                <option value="-1">Canceled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sales Date</label>
                            <input type="date" class="form-control" name="sales_dateCreated" required>
                        </div>
                        <div class="form-group">
                            <label>Member ID</label>
                            <input type="text" class="form-control" name="member_id" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" name="add_new" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Sales HTML -->
    <div id="edit_sales" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Sales</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="sales_id" class="get_sales_id">
                        <div class="form-group">
                            <label>Inventory ID</label>
                            <input type="text" class="form-control get_inv_id" name="inv_id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" class="form-control get_sales_qty" name="sales_qty" required>
                        </div>
                        <div class="form-group">
                            <label>Receipt</label>
                            <input type="file" class="form-control" name="sales_receipt">
                        </div>
                        <div class="form-group">
                            <label>Sales Status</label>
                            <br>
                            <select class="get_sales_status" name="sales_status" style="width:335px;height:40px">
                                <option value="2">Completed</option>
                                <option value="1">Delivered</option>
                                <option value="0">Pending</option>
                                <option value="-1">Canceled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sales Date</label>
                            <input type="date" class="form-control get_sales_dateCreated" name="sales_dateCreated" required>
                        </div>
                        <div class="form-group">
                            <label>Member ID</label>
                            <input type="text" class="form-control get_member_id" name="member_id" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" name="go_modify" value="Edit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Member Info Modal -->
    <div id="member_info" class="modal fade">
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
                var get_sales_id = $(this).attr("data-sales_id");
                var get_inv_id = $(this).attr("data-inv_id");
                var get_sales_qty = $(this).attr("data-sales_qty");
                var get_sales_status = $(this).attr("data-sales_status");
                var get_sales_dateCreated = $(this).attr("data-sales_dateCreated");
                var get_member_id = $(this).attr("data-member_id");

                $(".get_sales_id").val(get_sales_id);
                $(".get_inv_id").val(get_inv_id);
                $(".get_sales_qty").val(get_sales_qty);
                $(".get_sales_status").val(get_sales_status);
                $(".get_sales_dateCreated").val(get_sales_dateCreated);
                $(".get_member_id").val(get_member_id);
            });
            
            // Member Info Modal
            $(document).on('click', '.get_member', function(e) {

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

            
            $(".table-dropdown").click(function() {
                $(this).toggleClass("rotate");

                let tableTitle = $(this).parent().parent();
                let tableWrapper = tableTitle.parent();
                if (tableWrapper.attr("data-dropdown-hidden") === undefined) {
                    tableWrapper.attr("data-dropdown-hidden", "");
                    tableWrapper.animate({
                        height: tableTitle.outerHeight()
                    }, 500);
                } else {
                    tableWrapper.removeAttr("data-dropdown-hidden");
                    let height = tableWrapper.css("height", "auto").height();
                    tableWrapper.height(tableTitle.outerHeight()).animate({
                        height: height
                    }, 500);
                }
            });
        });
    </script>
</body>

</html>