<?php
include 'setup.php';
$query= tep_query("SELECT * FROM sales");
$chart_data='';
while($result = tep_fetch_object($query))
{
	$chart_data .="{inv_id: ".$result->inv_id, sales_qty:".$result->sales_qty, sales_status:".$result->sales_status, "sales_dateCreated:"$result->sales_dateCreated;
}
$chart_data=substr($chart_data,0,-2);
?>
<html>

	<head>

	<title> Analyses of Sales</title>	
	 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</head>

	<body>
		<br /> <br />
	   <div class="container" style="width:900px;">

	  	 <h2 align="center"> Graph</h2>
			<h3 align="center">Sales Data</h3>
			<br /> <br />

			<div id="chart"> </div>
	  </div>
    </body>
</html>

<script>
Morris.Bar({
	element: 'chart',
	data:[<?php echo $chart_data; ?>],
	xkey:'inventory',
	ykeys:['sales_qty','sales_status', 'sales_dateCreated'],
	labels:['sales_qty','sales_status', 'sales_dateCreated'],
	hideHover:'auto',
});