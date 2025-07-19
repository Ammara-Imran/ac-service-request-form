<?php
require '../dropdown_db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $dropdown_conn->prepare("DELETE FROM dropdown_options WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: dashboard.php");
exit;
?>
