<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Employee Listing - GoToGro</title>
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
			font-size: 13px;
		}

		.table-responsive {
			margin: 30px 0;
		}

		.table-wrapper {
			background: #fff;
			padding: 20px 25px;
			border-radius: 3px;
			min-width: 1000px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
		}

		.table-title {
			padding-bottom: 15px;
			background: #435d7d;
			color: #fff;
			padding: 16px 30px;
			min-width: 100%;
			margin: -20px -25px 10px;
			border-radius: 3px 3px 0 0;
		}

		.table-title h2 {
			margin: 5px 0 0;
			font-size: 24px;
		}

		.table-title .btn-group {
			float: right;
		}

		.table-title .btn {
			color: #fff;
			float: right;
			font-size: 13px;
			border: none;
			min-width: 50px;
			border-radius: 2px;
			border: none;
			outline: none !important;
			margin-left: 10px;
		}

		.table-title .btn i {
			float: left;
			font-size: 21px;
			margin-right: 5px;
		}

		.table-title .btn span {
			float: left;
			margin-top: 2px;
		}

		table.table tr th,
		table.table tr td {
			border-color: #e9e9e9;
			padding: 12px 15px;
			vertical-align: middle;
		}

		table.table tr th:first-child {
			width: 60px;
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

		table.table th i {
			font-size: 13px;
			margin: 0 5px;
			cursor: pointer;
		}

		table.table td:last-child i {
			opacity: 0.9;
			font-size: 22px;
			margin: 0 5px;
		}

		table.table td a {
			font-weight: bold;
			color: #566787;
			display: inline-block;
			text-decoration: none;
			outline: none !important;
		}

		table.table td a:hover {
			color: #2196F3;
		}

		table.table td a.edit {
			color: #FFC107;
		}

		table.table td a.delete {
			color: #F44336;
		}

		table.table td i {
			font-size: 19px;
		}

		table.table .avatar {
			border-radius: 50%;
			vertical-align: middle;
			margin-right: 10px;
		}

		.col-sm-4 {
			margin-left: 655px;
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

		/* Custom checkbox */
		.custom-checkbox {
			position: relative;
		}

		.custom-checkbox input[type="checkbox"] {
			opacity: 0;
			position: absolute;
			margin: 5px 0 0 3px;
			z-index: 9;
		}

		.custom-checkbox label:before {
			width: 18px;
			height: 18px;
		}

		.custom-checkbox label:before {
			content: '';
			margin-right: 10px;
			display: inline-block;
			vertical-align: text-top;
			background: white;
			border: 1px solid #bbb;
			border-radius: 2px;
			box-sizing: border-box;
			z-index: 2;
		}

		.custom-checkbox input[type="checkbox"]:checked+label:after {
			content: '';
			position: absolute;
			left: 6px;
			top: 3px;
			width: 6px;
			height: 11px;
			border: solid #000;
			border-width: 0 3px 3px 0;
			transform: inherit;
			z-index: 3;
			transform: rotateZ(45deg);
		}

		.custom-checkbox input[type="checkbox"]:checked+label:before {
			border-color: #03A9F4;
			background: #03A9F4;
		}

		.custom-checkbox input[type="checkbox"]:checked+label:after {
			border-color: #fff;
		}

		.custom-checkbox input[type="checkbox"]:disabled+label:before {
			color: #b8b8b8;
			cursor: auto;
			box-shadow: none;
			background: #ddd;
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

		.errMsg {
			color: red;
			font-size: 12px;
		}
	</style>
	<script>
		$(document).ready(function() {
			// Activate tooltip
			$('[data-toggle="tooltip"]').tooltip();
		});


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
	if ($getuser->emp_position >= 9) {
		// do nothing
	} else {
		echo alert("You do not have sufficient permissions to access this page.");
		if ($getuser->emp_position == 2) {
			echo redirect("site_product.php");
		} else {
			echo redirect("order.php");
		}
	}
	?>

	<!---Content---->
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2><b>Employees</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
							<a onclick="reload()" class="btn btn-info" data-toggle="modal"><i class="material-icons">&#xe5d5;</i> <span>Refresh</span></a>
						</div>
						<br><br><br>
						<div class="col-sm-4">
							<div class="search-box">
								<i class="material-icons">&#xE8B6;</i>
								<input type="text" id="search_input" placeholder="Search&hellip;">
							</div>
						</div>
					</div>
				</div>
				<!-- load table -->
				<div id="employee_listing"></div>
			</div>
		</div>
	</div>

	<!-- Add Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div>
					<div class="modal-header">
						<h4 class="modal-title">Add Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>ID</label>
							<div class="cursor-not-allowed">
								<input type="text" class="form-control avoid-clicks" value="AUTO-GENERATED">
							</div>
						</div>
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" id="emp_name_a">
							<span class="errMsg nameErr"></span>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control" id="emp_email_a">
							<span class="errMsg emailErr"></span>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" id="emp_password_a">
							<span class="errMsg passwordErr"></span>
						</div>

						<div class="form-group">
							<label>Position</label>
							<br>
							<select class="get_status" style="width:335px;height:40px" id="emp_position_a">
								<option value="0">ACL: 1 (Delivery Staff)</option>
								<option value="1">ACL: 2 (In-store Staff)</option>
								<option value="2">ACL: 3 (Site-management Staff)</option>
								<option value="9">ACL: All (Manager)</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add" onclick="go_add_user()">
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div>
					<div class="modal-header">
						<h4 class="modal-title">Edit Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>ID</label>
							<div class="cursor-not-allowed">
								<input type="text" class="form-control avoid-clicks get_id" id="emp_id_m">
							</div>
						</div>
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control get_name" id="emp_name_m">
						</div>
						<div class="form-group">
							<label>Contact</label>
							<input type="text" class="form-control get_contact" id="emp_contact_m">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control get_email" id="emp_email_m">
						</div>
						<div class="form-group">
							<label>Position</label>
							<br>
							<select class="get_position" id="emp_position_m" style="width:335px;height:40px">
								<option value="0">ACL: 1 (Delivery Staff)</option>
								<option value="1">ACL: 2 (In-store Staff)</option>
								<option value="2">ACL: 3 (Site-management Staff)</option>
								<option value="9">ACL: All (Manager)</option>
							</select>
						</div>
						<div class="form-group">
							<label>Status</label>
							<br>
							<select class="get_status" id="emp_status_m" style="width:335px;height:40px">
								<option value="1">Active</option>
								<option value="0">Deactived</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" onclick="go_modify()" value="Save">
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div>
					<div class="modal-header">
						<h4 class="modal-title">Delete Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete <b class="get_email"></b>?</p>
						<input type="hidden" id="emp_id_d" class="get_id">
						<input type="hidden" id="emp_email_d" class="get_email">
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" onclick="go_del()" value="Delete">
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/employee_listing.js"></script>

	<!-- Edit and Del get_value setup -->
	<script>
		// Edit Popup
		$(document).ready(function() {
			$(document).on('click', '.get_edit', function(e) {

				var get_id = $(this).attr("data-id");
				var get_name = $(this).attr("data-name");
				var get_contact = $(this).attr("data-contact");
				var get_email = $(this).attr("data-email");
				var get_position = $(this).attr("data-position");
				var get_status = $(this).attr("data-status");

				$(".get_id").val(get_id);
				$(".get_name").val(get_name);
				$(".get_contact").val(get_contact);
				$(".get_email").val(get_email);
				$(".get_position").val(get_position);
				$(".get_status").val(get_status);

			});
		});

		// Del Popup
		$(document).ready(function() {
			$(document).on('click', '.get_del', function(e) {

				var get_id = $(this).attr("data-id");
				var get_email = $(this).attr("data-email");

				$(".get_id").val(get_id);
				$(".get_email").html(get_email);
			});
		});
	</script>

	<!-- reload & auto-load table -->
	<script>
		// Auto-load
		$(document).ready(function() {
			// Load Emp Listing
			$("#employee_listing").load("ajax/employee_listing_ajax.php");
		});
		// Reload
		function reload() {
			$("#employee_listing").load("ajax/employee_listing_ajax.php");
		}
	</script>
</body>

</html>