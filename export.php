<?php
include_once("setup.php");
$query = "SELECT * FROM sales ";


$result = mysqli_query($conn, $query);
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