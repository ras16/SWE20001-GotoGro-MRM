<?php include '../setup.php';
tep_query("UPDATE employees SET emp_status = 0 WHERE emp_id = '" . $_POST['emp_id'] . "'");
print "el_go_del";
?>