<?php include '../setup.php';
tep_query("UPDATE members SET members_status = -2 WHERE members_id = '" . $_POST['members_id'] . "'");
?>