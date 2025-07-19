<?php
session_start();
require 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

$dropdowns = [
    'Company Name' => 'Company Names',
    'Dealer Name' => 'Dealer Names',
    'Brand' => 'Brands',
    'Item Description' => 'Item Descriptions',
    'Customer Name' => 'Customer Names',
    'Address' => 'Addresses',
    'Technician Name' => 'Technician Names',
    'Job Completion Status' => 'Job Completion Status',
    'Job Type' => 'Job Types'
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <?php foreach ($dropdowns as $field => $label): ?>
                <li><a href="#<?= strtolower(str_replace(' ', '_', $field)) ?>"><?= $label ?></a></li>
            <?php endforeach; ?>
            <li><a href="logout.php" class="logout-btn">Logout</a></li>
        </ul>
    </div>

    <!-- Main Panel -->
    <div class="main-content">
        <h1>Manage Dropdown Options</h1>

        <?php foreach ($dropdowns as $field => $label): ?>
            <div class="dropdown-section" id="<?= strtolower(str_replace(' ', '_', $field)) ?>">
                <h3><?= $label ?></h3>

                <!-- Add new option form -->
                <form action="save_dropdown.php" method="post" class="add-form">
                    <input type="hidden" name="field_name" value="<?= htmlspecialchars($field) ?>">
                    <input type="text" name="option_value" placeholder="Add new <?= strtolower($label) ?>" required>
                    <button type="submit">Add</button>
                </form>

                <div class="item-list">
                    <?php
                    $stmt = $conn->prepare("SELECT id, option_value FROM dropdown_options WHERE field_name = ? ORDER BY id DESC");
                    $stmt->bind_param("s", $field);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()):
                    ?>
                            <div class="item-row">
                                <span><?= htmlspecialchars($row['option_value']) ?></span>
                                <a href="delete_dropdown.php?id=<?= $row['id'] ?>" class="delete-btn">Delete</a>
                            </div>
                    <?php
                        endwhile;
                    else:
                        echo "<p style='color:gray;'>No options added yet.</p>";
                    endif;
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
