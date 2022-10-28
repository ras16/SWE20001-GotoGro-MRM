<?php
include_once("setup.php");
$query = "SELECT * FROM sales ";


$file_selected = 

'SELECT CONCAT(MONTHNAME(`sales_dateCreated`), " ", 
YEAR(`sales_dateCreated`)) AS `month_year`,
`inv_title`, 
ROUND(SUM(`inv_price` * `sales_qty`), 2) AS `sales`
FROM `sales` NATURAL JOIN `inventory`
WHERE `sales_status` = 2
GROUP BY `month_year`
ORDER BY `sales_dateCreated`';


$result = mysqli_query($conn, $file_selected);
$records = array();
while( $rows = mysqli_fetch_assoc($result) ) {
	$records[] = $rows;
}	

if(isset($_POST["export_csv_data"])) {	
	$csv_file = "gotogro_SalesReport". ".csv";			
	header("Content-Type: text/csv");
	header("Content-Disposition: attachment; filename=\"$csv_file\"");	
	$fh = fopen( 'php://output', 'w' );
	$is_coloumn = true;
	if(!empty($records)) {
	  foreach($records as $record) {
		if($is_coloumn) {		  	  
		  fputcsv($fh, array_keys($record));
		  $is_coloumn = false;
		}		
		fputcsv($fh, array_values($record));
	  }
	   fclose($fh);
	}
	exit;  
}

?>