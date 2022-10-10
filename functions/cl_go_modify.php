<?php include 'setup.php';

header('Content-Type: application/json');

tep_query("UPDATE members SET
members_name = '" . $_POST['members_name'] . "',
members_contact = '" . $_POST['members_contact'] . "',
members_email = '" . $_POST['members_email'] . "',
members_address = '" . $_POST['members_address'] . "',
members_status = '" . $_POST['members_status'] . "'
WHERE members_id = '" . $_POST['members_id'] . "'
");
echo json_encode(
    array(
        'type' => 'cl_go_modify',
        'status' => 'success'
    )
);
exit;
?>