<?php
require '../dropdown_db.php'; // dropdown_db.php me dropdown_options ki DB connection honi chahiye

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $field_name = trim($_POST['field_name']);
    $option_value = trim($_POST['option_value']);

    if ($field_name === '' || $option_value === '') {
        header("Location: dashboard.php?error=Empty value");
        exit;
    }

    $stmt = $dropdown_conn->prepare("INSERT INTO dropdown_options (field_name, option_value) VALUES (?, ?)");
    $stmt->bind_param("ss", $field_name, $option_value);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>
