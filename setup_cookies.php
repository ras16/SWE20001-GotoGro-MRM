<?php include 'library/library.php';

header('Content-Type: application/json');

if (isset($_GET["emp_email"])) {
    $infoRow = tep_fetch_object(tep_query("SELECT * FROM employees WHERE emp_email = '" . $_GET["emp_email"] . "'"));
    if ($infoRow->emp_status == 1) {
        setcookie("token", $infoRow->emp_id, time() + (86400 * 365), "/");
        redirect('members_listing.php');
        /*if ($infoRow->emp_position >= 0 && $infoRow->emp_position != 2) {
            redirect('orders.php');
        } else if ($infoRow->emp_position == 2) {
            redirect('site_product.php');
        }*/
    } else {
        redirect('login.php', '?blocked=1');
    }
} else if (isset($_GET["logout"])) {
    setcookie("token", $infoRow->emp_id, time() - (86400 * 365), "/");
    echo header("location: login.php");
} else {
    $infoRow = tep_fetch_object(tep_query("SELECT * FROM employees WHERE emp_email = '" . $_POST["emp_email"] . "' AND emp_password = '" . md5($_POST["emp_password"]) . "'"));

    if (!isset($infoRow->emp_id)) {
        echo json_encode(
            array(
                'type' => 'login_cookies',
                'status' => 'failure'
            )
        );
    } else {
        echo json_encode(
            array(
                'type' => 'login_cookies',
                'status' => 'success'
            )
        );
    }
}
