<?php include 'setup.php';

header('Content-Type: application/json');

$infoRow = tep_fetch_object(tep_query("SELECT * FROM employees WHERE emp_email = '" . tep_input($_POST["emp_email"]) . "'"));

if (!isset($infoRow->emp_id)) {
    tep_query("INSERT INTO employees(
        emp_name,
        emp_email,
        emp_password,
        emp_position,
        emp_status,
        emp_dateCreated
    )VALUES(
        '" . $_POST["emp_name"] . "',
        '" . $_POST["emp_email"] . "',
        '" . md5($_POST["emp_password"]) . "',
        '" . $_POST["emp_position"] . "',
        1,
        now()
    )");
    echo json_encode(
        array(
            'type' => 'el_go_add_user',
            'status' => 'success'
        )
    );
} else {
    echo json_encode(
        array(
            'type' => 'el_go_add_user',
            'status' => 'failure'
        )
    );
}
?>