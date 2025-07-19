<?php
include 'db.php'; // connects to AC_JOB_SYSTEM

$type = $_POST['type'];
$name = trim($_POST['name']);
$action = $_POST['action']; // 'add' or 'delete'

$tableMap = [
    "company" => "companies",
    "dealer" => "dealers",
    "brand" => "brands",
    "item" => "items",
    "customer" => "customers",
    "address" => "addresses",
    "technician" => "technicians"
];

$table = $tableMap[$type];

if ($action == 'add') {
    $stmt = $conn->prepare("INSERT INTO $table (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    if ($stmt->execute()) {
        echo "added";
    } else {
        echo "error";
    }
    $stmt->close();
}

if ($action == 'delete') {
    $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->bind_param("i", $_POST['id']);
    if ($stmt->execute()) {
        echo "deleted";
    } else {
        echo "error";
    }
    $stmt->close();
}
?>
