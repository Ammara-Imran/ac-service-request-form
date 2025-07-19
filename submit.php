<?php
include 'db.php';

// Prepare SQL using prepared statements for safety
$stmt = $conn->prepare("INSERT INTO jobs (
    company_name, job_received_date, job_type, job_complete_date,
    dealer_name, brand, item_description, customer_name, contact,
    address, qty, complain_number, outdoor_serial, technician_name,
    remarks, payment_amount, job_completion_status, last_updated_by
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param(
    "ssssssssssisssssis",
    $_POST['company_name'],
    $_POST['job_received_date'],
    $_POST['job_type'],
    $_POST['job_complete_date'],
    $_POST['dealer_name'],
    $_POST['brand'],
    $_POST['item_description'],
    $_POST['customer_name'],
    $_POST['contact'],
    $_POST['address'],
    $_POST['qty'],
    $_POST['complain_number'],
    $_POST['outdoor_serial'],
    $_POST['technician_name'],
    $_POST['remarks'],
    $_POST['payment_amount'],
    $_POST['job_status'], // ✅ NOTE: 'job_status' matches form.php
    $_POST['last_updated_by']
);

// Execute and give response
if ($stmt->execute()) {
    echo "<div style='padding:20px; font-family:sans-serif; background:#e0ffe0; border:1px solid #b2d8b2; max-width:500px; margin:50px auto; text-align:center;'>
            ✅ Job submitted successfully.<br><br>
            <a href='form.php' style='color:#007BFF;'>← Back to Form</a>
          </div>";
} else {
    echo "<div style='padding:20px; font-family:sans-serif; background:#ffe0e0; border:1px solid #d8b2b2; max-width:500px; margin:50px auto; text-align:center;'>
            ❌ Error: " . htmlspecialchars($stmt->error) . "<br><br>
            <a href='form.php' style='color:#007BFF;'>← Try Again</a>
          </div>";
}

$stmt->close();
$conn->close();
?>
