<?php
$conn = new mysqli("localhost", "root", "", "ac_company");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>