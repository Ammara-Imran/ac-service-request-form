<?php
$dropdown_conn = new mysqli("localhost", "root", "", "admin_db");
if ($dropdown_conn->connect_error) {
    die("Dropdown DB connection failed: " . $dropdown_conn->connect_error);
}
?>
