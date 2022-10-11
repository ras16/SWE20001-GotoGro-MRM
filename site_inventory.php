<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>inventory - GotoGro-MRM</title>
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
            width: 1100px;
            background: #fff;
            margin: 0 auto;
            padding: 20px 30px 5px;
            box-shadow: 0 0 1px 0 rgba(0, 0, 0, .25);
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
    if ($getuser->emp_position >= 2) {
        // do nothing
    } else {
        echo alert("You do not have sufficient permissions to access this page.");
        if ($getuser->emp_position == 2) {
            echo redirect("site_inventory.php");
        } else {
            echo redirect("Sales.php");
        }
    }
    ?>
    <?php
    if (isset($_POST["add_new"])) {
        $file = $_FILES["file"];

        $fileName = $_FILES["file"]["name"];
        $fileTmpName = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileError = $_FILES["file"]["error"];
        $fileType = $_FILES["file"]["type"];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array("jpg", "jpeg", "png");

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = "../../images/" . $fileNameNew;
                    // START - Upload 
                    move_uploaded_file($fileTmpName, $fileDestination);
                    tep_query("INSERT INTO inventory(
                        inv_title,
                        inv_image,
                        inv_description,
                        inv_price,
                        best_seller,
                        inv_status
                    )VALUES(
                        '" . $_POST["inv_title"] . "',
                        '" . $fileNameNew . "',
                        '" . $_POST["inv_description"] . "',
                        '" . $_POST["inv_price"] . "',
                        '" . $_POST["best_seller"] . "',
                        '" . $_POST["inv_status"] . "'
                    );");
                    echo redirect("site_inv.php?add_new=success");
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

    if (isset($_POST["go_modify"])) {
        if ($_FILES['file']['size'] == 0) {
            tep_query("UPDATE inventory SET
            inv_title = '" . $_POST["inv_title"] . "',
            inv_description = '" . $_POST["inv_description"] . "',
            inv_price = '" . $_POST["inv_price"] . "',
            best_seller = '" . $_POST["best_seller"] . "',
            inv_status = '" . $_POST["inv_status"] . "'
            WHERE inv_id = '" . $_POST["inv_id"] . "'
            ");
        } else {
            $file = $_FILES["file"];

            $fileName = $_FILES["file"]["name"];
            $fileTmpName = $_FILES["file"]["tmp_name"];
            $fileSize = $_FILES["file"]["size"];
            $fileError = $_FILES["file"]["error"];
            $fileType = $_FILES["file"]["type"];

            $fileExt = explode(".", $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array("jpg", "jpeg", "png");

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 1000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = "../../images/" . $fileNameNew;
                        // START - Upload 
                        move_uploaded_file($fileTmpName, $fileDestination);
                        tep_query("UPDATE inventory SET
                        inv_title = '" . $_POST["inv_title"] . "',
                        inv_image = '" . $fileNameNew . "',
                        inv_description = '" . $_POST["inv_description"] . "',
                        inv_price = '" . $_POST["inv_price"] . "',
                        best_seller = '" . $_POST["best_seller"] . "',
                        inv_status = '" . $_POST["inv_status"] . "'
                        WHERE inv_id = '" . $_POST["inv_id"] . "'
                        ");
                        echo redirect("site_inv.php?modify=success");
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
        echo redirect("site_inv.php?modify=success");
    }

    if (isset($_POST["go_del"])) {
        tep_query("UPDATE inventory SET
        inv_status = -1
        WHERE inv_id = '" . $_POST["emp_id_d"] . "'");
    }
    ?>

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b>inventory</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-info active">
                                    <input type="radio" name="status" value="all" checked="checked"> All
                                </label>
                                <label class="btn btn-success">
                                    <input type="radio" name="status" value="active"> Active
                                </label>
                                <label class="btn btn-danger">
                                    <input type="radio" name="status" value="inactive"> Inactive
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
                    <a href="#add_inv" class="btn btn-info" data-toggle="modal"> <span>Add inventory</span></a>
                </div>
                <br>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Model</th>
                            <th>Price</th>
                            <th>inventory Detail</th>
                            <th>Best Seller</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        $cnt = 0;

                        $qryRow = tep_query("SELECT * FROM inventory WHERE inv_status >= 0 ORDER BY inv_id ASC");
                        while ($infoRow = tep_fetch_object($qryRow)) {
                            $cnt++;
                            $id = $infoRow->inv_id;
                            $title = $infoRow->inv_title;
                            $image = $infoRow->inv_image;
                            $desc = $infoRow->inv_description;
                            $price = $infoRow->inv_price;
                            $best_seller = $infoRow->best_seller;
                            $status = $infoRow->inv_status;

                            if ($status == 1) {
                                echo '<tr data-status="active">';
                            } else if ($status == 0) {
                                echo '<tr data-status="inactive">';
                            }
                            echo '
                            <td>' . $cnt . '</td>
                            <td><img src="../../images/' . $image . '" class="flower" alt="Flower" style="width:40px;height:40px"></td>
                            <td>' . $title . '</td>
                            <td>RM ' . $price . '</td>
                            <td>' . $desc . '</td>';
                            if ($best_seller == 1) {
                                echo '<td><span class="badge badge-success">Yes</span></td>';
                            } else if ($best_seller == 0) {
                                echo '<td><span class="badge badge-danger">No</span></td>';
                            }

                            if ($status == 1) {
                                echo '<td><span class="badge badge-success">Active</span></td>';
                            } else if ($status == 0) {
                                echo '<td><span class="badge badge-danger">Inactive</span></td>';
                            }
                            echo '
                            <td>
                            <a href="#edit_inv" class="edit" data-toggle="modal">
                            <i class="material-icons get_edit" data-toggle="modal" title="Edit"
                            data-id="' . $id . '"
                            data-title="' . $title . '"
                            data-image="' . $image . '"
                            data-desc="' . $desc . '"
                            data-price="' . $price . '"
                            data-best_seller = "' . $best_seller . '"
                            data-status="' . $status . '"
                            >&#xE254;
                            </i>
                            </a>

                            <a href="#delete_inv" class="delete" data-toggle="modal">
                            <i class="material-icons get_del" data-toggle="modal" title="Delete"
                            data-id="' . $id . '"
                            data-title="' . $title . '"
                            >&#xE872;
                            </i>
                            </a>
                            </td>
                            </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Modal HTML -->
    <div id="add_inv" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Add inventory</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Main Image</label>
                            <input type="file" class="form-control" name="file" style="height:45px" />
                        </div>
                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" class="form-control" name="inv_title">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control" name="inv_price">
                        </div>
                        <div class="form-group">
                            <label>Best Seller</label>
                            <br>
                            <select name="best_seller" style="width:335px;height:40px">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <br>
                            <select name="inv_status" style="width:335px;height:40px">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="form-group">
                            <label>inventory Details</label>
                            <textarea class="form-control" name="inv_description" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="submit" class="btn btn-info" name="add_new">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal HTML -->
    <div id="edit_inv" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit inventory</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="inv_id" class="get_id">
                            <label>Image</label>
                            <input type="file" class="form-control" style="height:45px" name="file" />
                        </div>
                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" class="form-control get_title" name="inv_title" required>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control get_price" name="inv_price" required>
                        </div>
                        <div class="form-group">
                            <label>Best Seller</label>
                            <br>
                            <select name="best_seller" class="get_best_seller" style="width:335px;height:40px">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <br>
                            <select name="inv_status" class="get_status" style="width:335px;height:40px">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="form-group">
                            <label>inventory Details</label>
                            <textarea class="form-control get_desc" name="inv_description" required></textarea>
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

    <!-- Delete Modal HTML -->
    <div id="delete_inv" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete inventory</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <b class="get_title"></b>?</p>
                        <input type="hidden" name="emp_id_d" class="get_id">
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" name="go_del" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit and Del get_value setup -->
    <script>
        // Edit Popup
        $(document).ready(function() {
            $(document).on('click', '.get_edit', function(e) {

                var get_id = $(this).attr("data-id");
                var get_title = $(this).attr("data-title");
                var get_image = $(this).attr("data-image");
                var get_desc = $(this).attr("data-desc");
                var get_price = $(this).attr("data-price");
                var get_best_seller = $(this).attr("data-best_seller");
                var get_status = $(this).attr("data-status");

                $(".get_id").val(get_id);
                $(".get_title").val(get_title);
                $(".get_image").val(get_image);
                $(".get_desc").val(get_desc);
                $(".get_price").val(get_price);
                $(".get_best_seller").val(get_best_seller);
                $(".get_status").val(get_status);

            });
        });

        // Del Popup
        $(document).ready(function() {
            $(document).on('click', '.get_del', function(e) {

                var get_id = $(this).attr("data-id");
                var get_title = $(this).attr("data-title");

                $(".get_id").val(get_id);
                $(".get_title").html(get_title);
            });
        });
    </script>
</body>

</html>