<?php

require 'library/library.php';

$conn = tep_db_connect();
mysqli_set_charset($conn, DB_CHARSET);
tep_query("SET time_zone = '+8:00'");
session_start();

?>