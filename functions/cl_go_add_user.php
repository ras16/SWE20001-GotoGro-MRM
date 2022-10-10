<?php include 'setup.php';

header('Content-Type: application/json');

$infoRow = tep_fetch_object(tep_query("SELECT * FROM members WHERE members_email = '" . tep_input($_POST["members_email"]) . "'"));
if (!isset($infoRow->member_id)) {
    tep_query("INSERT INTO members(
        members_name,
        members_contact,
        members_email,
        members_address,
        members_status,
        members_dateCreated
    )VALUES(
        '" . $_POST["members_name"] . "',
        '" . $_POST["members_contact"] . "',
        '" . $_POST["members_email"] . "',
        '" . $_POST["members_address"] . "',
        1,
        now()
    )");
    echo json_encode(
        array(
            'type' => 'cl_go_add_user',
            'status' => 'success'
        )
    );
} else {
    echo json_encode(
        array(
            'type' => 'cl_go_add_user',
            'status' => 'failure'
        )
    );
}

?>