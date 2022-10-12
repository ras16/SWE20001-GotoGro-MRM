<?php include '../setup.php';

header('Content-Type: application/json');

tep_query("UPDATE employees SET
emp_name = '" . $_POST['emp_name'] . "',
emp_contact = '" . $_POST['emp_contact'] . "',
emp_email = '" . $_POST['emp_email'] . "',
emp_position = '" . $_POST['emp_position'] . "',
emp_status = '" . $_POST['emp_status'] . "'
WHERE emp_id = '" . $_POST['emp_id'] . "'
");
echo json_encode(
    array(
        'type' => 'el_go_modify',
        'status' => 'success'
    )
);
exit;

?>