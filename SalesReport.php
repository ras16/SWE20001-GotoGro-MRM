<?php 
include 'setup.php'; 
include 'export.php';
?>


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

        .button {
            border: none;
            color: white;
            padding: 15px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 83px;
            cursor: pointer;
            background-color: #212F3C;
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
                            <h2>Monthly Sales <b>Report</b></h2>
                        </div>
                        <div class="col-sm-4 month-pickers">
                            <label>After Month:&nbsp;</label><input type="month" id="after-month">
                            <br>
                            <label>Before Month:&nbsp;</label><input type="month" id="before-month">
                        </div>
                    </div>
                </div>
                <div class="table-content">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Month/Year</th>
                                <?php
                                    $inventory_query = tep_query('SELECT `inv_title` FROM `inventory` ORDER BY `inv_id`');
                                    while ($inventory_row = tep_fetch_object($inventory_query)) {
                                        echo "<th>{$inventory_row->inv_title}</th>";
                                    }
                                ?>
                                <th>Total Sales</th>
                            </tr>
                        </thead>
                        <tbody id="monthly-sales-report">
                            <?php
                                $query = tep_query(
                                    'SELECT
                                        CONCAT(MONTHNAME(`sales_dateCreated`), " ", YEAR(`sales_dateCreated`)) AS `month_year`,
                                        `inv_id`,
                                        ROUND(SUM(`inv_price` * `sales_qty`), 2) AS `sales`
                                    FROM `sales` NATURAL JOIN `inventory`
                                    WHERE `sales_status` = 2
                                    GROUP BY `month_year`, `inv_id`;');
                                while ($result = tep_fetch_object($query)) {
                                    $report[$result->month_year][$result->inv_id] = $result->sales;
                                }

                                $inv_query = tep_query('SELECT `inv_id` FROM `inventory` ORDER BY `inv_id`');
                                while ($inv_row = tep_fetch_object($inv_query)) {
                                    $columns[] = $inv_row->inv_id;
                                }

                                $month_year_query = tep_query(
                                    'SELECT
                                        CONCAT(MONTHNAME(`sales_dateCreated`), " ", YEAR(`sales_dateCreated`)) AS `month_year`,
                                        TIMESTAMPADD(MONTH, TIMESTAMPDIFF(MONTH, "1970-01-01", `sales_dateCreated`), "1970-01-01") AS `sales_month`,
                                        ROUND(SUM(`inv_price` * `sales_qty`), 2) AS `total_sales`
                                    FROM `sales` NATURAL JOIN `inventory`
                                    WHERE `sales_status` = 2
                                    GROUP BY `month_year`
                                    ORDER BY `sales_dateCreated`');
                                while ($month_year_row = tep_fetch_object($month_year_query)) {
                                    echo "<tr data-sales_month=\"{$month_year_row->sales_month}\">";
                                    $row = $month_year_row->month_year;
                                    echo "<td>$row</td>";
                                    foreach ($columns as $column) {
                                        $sales = isset($report[$row][$column]) ? $report[$row][$column] : '0.00';
                                        echo "<td>RM $sales</td>";
                                    }
                                    echo "<td>RM {$month_year_row->total_sales}</td>";
                                    echo '</tr>';
                                }

                                
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
<div class="well-sm col-sm-12">
		<div class="btn-group pull-right">	
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">					
				<button class="button button" type="submit" id="export_csv_data" name='export_csv_data' value="Export to CSV" class="btn btn-info">Generate CSV file</button>
			</form>
		</div>
	</div>
    
</body>
</html>