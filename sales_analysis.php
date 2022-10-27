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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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

        .chart {
            width: 1000px;
            height: 450px;
        }
    </style>
    <script>
        $(document).ready(function() {
			new Morris.Bar({
                element: 'bar-chart',
                data: <?php
                    $query = tep_query(
                        'SELECT inv_title, SUM(inv_price * sales_qty) AS sales
                        FROM sales NATURAL JOIN inventory
                        GROUP BY inv_id');
                    while ($infoRow = tep_fetch_object($query)) {
                        $data[] = ['inventory' => $infoRow->inv_title, 'sales' => $infoRow->sales];
                    }
                    echo json_encode($data);
                ?>,
                xkey: "inventory",
                ykeys: ["sales"],
                labels: ["Sales"],
                hideHover: true,
                preUnits: "RM"
            });

			new Morris.Area({
                element: 'area-chart',
                data: <?php
                    $data = [];
                    $query = tep_query(
                        'SELECT
                            CONCAT(MONTHNAME(`sales_dateCreated`), " ", YEAR(`sales_dateCreated`)) AS `month_year`,
                            `inv_title`,
                            ROUND(SUM(`inv_price` * `sales_qty`), 2) AS `sales`
                        FROM `sales` NATURAL JOIN `inventory`
                        WHERE `sales_status` = 2
                        GROUP BY `month_year`, `inv_id`');
                    while ($result = tep_fetch_object($query)) {
                        $data[$result->month_year][$result->inv_title] = $result->sales;
                    }

                    $inv_query = tep_query('SELECT inv_title FROM inventory');
                    while ($infoRow = tep_fetch_object($inv_query)) {
                        $inv_data[] = $infoRow->inv_title;
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
                        $tmp = $data[$month_year_row->month_year];
                        foreach ($inv_data as $inv) {
                            if (!isset($tmp[$inv])) {
                                $tmp[$inv] = 0;
                            }
                        }
                        $tmp['month'] = $month_year_row->sales_month;
                        $month_year_data[] = $tmp;
                    }

                    echo json_encode($month_year_data);
                ?>,
                xkey: "month",
                ykeys: <?php
                    echo json_encode($inv_data);
                ?>,
                labels: <?php
                    echo json_encode($inv_data);
                ?>,
                xLabels: "month",
                hideHover: true,
                preUnits: "RM",
                behaveLikeLine: true
            });

            /*new Morris.Donut({
                element: 'donut-chart',
                data: <?php
                    $data = [];
                    $query = tep_query(
                        'SELECT sales_status, COUNT(sales_id) AS count
                        FROM sales
                        GROUP BY sales_status
                        ORDER BY sales_status DESC');
                    while ($infoRow = tep_fetch_object($query)) {
                        switch ($infoRow->sales_status) {
                            case 2:
                                $label = 'Completed';
                                break;
                            case 1:
                                $label = 'Delivered';
                                break;
                            case 0:
                                $label = 'Pending';
                                break;
                            case -1:
                                $label = 'Canceled';
                                break;
                            default:
                                break;
                        }
                        $data[] = ['label' => $label, 'value' => $infoRow->count];
                    }
                    echo json_encode($data);
                ?>,
                colors: ["#007bff", "#28a745", "#ffc107", "#dc3545"]
            });*/
            new Morris.Donut({
                element: 'donut-chart',
                data: <?php
                    $data = [];
                    $query = tep_query(
                        'SELECT inv_title, SUM(sales_qty) AS quantity
                        FROM sales NATURAL JOIN inventory
                        GROUP BY inv_id');
                    while ($infoRow = tep_fetch_object($query)) {
                        $data[] = ['label' => $infoRow->inv_title, 'value' => $infoRow->quantity];
                    }
                    echo json_encode($data);
                ?>
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
	?>
    <div id="area-like-line"></div>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b>Sales</b> by <b>Product</b></h2>
                        </div>
                    </div>
                </div>
                <div id="bar-chart"></div>
            </div>
        </div>
    </div>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b>Monthly Sales</b> by <b>Product</b></h2>
                        </div>
                    </div>
                </div>
                <div id="area-chart"></div>
            </div>
        </div>
    </div>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Members' Grocery <b>Needs</b></h2>
                        </div>
                    </div>
                </div>
                <div id="donut-chart"></div>
            </div>
        </div>
    </div>
</body>

</html>