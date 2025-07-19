<?php 
require 'db.php';
require 'dropdown_db.php';

// --- Dropdown Fetch Function ---
function getOptions($dropdown_conn, $field) {
    $stmt = $dropdown_conn->prepare("SELECT option_value FROM dropdown_options WHERE field_name = ?");
    $stmt->bind_param("s", $field);
    $stmt->execute();
    $result = $stmt->get_result();
    $options = [];
    while ($row = $result->fetch_assoc()) {
        $options[] = $row['option_value'];
    }
    return $options;
}

// --- Get dropdown data ---
$company_options = getOptions($dropdown_conn, 'Company Name');
$dealer_options = getOptions($dropdown_conn, 'Dealer Name');
$brand_options = getOptions($dropdown_conn, 'Brand');
$item_options = getOptions($dropdown_conn, 'Item Description');
$customer_options = getOptions($dropdown_conn, 'Customer Name');
$address_options = getOptions($dropdown_conn, 'Address');
$technician_options = getOptions($dropdown_conn, 'Technician Name');
$jobtype_options = getOptions($dropdown_conn, 'Job Type');
$status_options = getOptions($dropdown_conn, 'Job Completion Status');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AC Job Entry Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e6f7ff; }
        .container { max-width: 850px; margin-top: 30px; }
        .card { border-radius: 15px; padding: 20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="card shadow">
        <h2 class="text-center mb-4">Add New AC Job</h2>
        <form action="submit.php" method="POST">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label>Company Name</label>
                    <select name="company_name" class="form-select" required>
                        <option value="">Select</option>
                        <?php foreach ($company_options as $option): ?>
                            <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label>Job Received Date</label>
                    <input type="date" name="job_received_date" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label>Job Type</label>
                    <select name="job_type" class="form-select">
                        <option value="">Select</option>
                        <?php foreach ($jobtype_options as $option): ?>
                            <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label>Job Complete Date</label>
                    <input type="date" name="job_complete_date" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label>Dealer Name</label>
                    <select name="dealer_name" class="form-select">
                        <option value="">Select</option>
                        <?php foreach ($dealer_options as $option): ?>
                            <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label>Brand</label>
                    <select name="brand" class="form-select">
                        <option value="">Select</option>
                        <?php foreach ($brand_options as $option): ?>
                            <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>Item Description</label>
                <select name="item_description" class="form-select">
                    <option value="">Select</option>
                    <?php foreach ($item_options as $option): ?>
                        <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label>Customer Name</label>
                    
    <input type="text" name="customer_name" class="form-control" required>
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label>Contact</label>
                    <input type="text" name="contact" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <select name="address" class="form-select">
                    <option value="">Select</option>
                    <?php foreach ($address_options as $option): ?>
                        <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label>Qty</label>
                    <input type="number" name="qty" class="form-control">
                </div>
                <div class="mb-3 col-md-4">
                    <label>Complain Number</label>
                    <input type="text" name="complain_number" class="form-control">
                </div>
                <div class="mb-3 col-md-4">
                    <label>Outdoor Serial #</label>
                    <input type="text" name="outdoor_serial" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label>Technician Name</label>
                <select name="technician_name" class="form-select">
                    <option value="">Select</option>
                    <?php foreach ($technician_options as $option): ?>
                        <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Remarks</label>
                <textarea name="remarks" class="form-control"></textarea>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label>Payment Amount</label>
                    <input type="number" name="payment_amount" class="form-control">
                </div>
                <div class="mb-3 col-md-6">
                    <label>Job Completion Status</label>
                    <select name="job_completion_status" class="form-select" id="job_status">
                        <option value="">Select</option>
                        <?php foreach ($status_options as $option): ?>
                            <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>Last Updated By</label>
                <input type="text" name="last_updated_by" class="form-control">
            </div>

<button type="submit" class="btn btn-primary w-100" id="submitBtn" disabled>Submit Job</button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const complainInput = document.querySelector('input[name="complain_number"]');
    const jobStatus = document.getElementById("job_status");
    let completedOption;

    // Find the Completed option inside job_status select
    Array.from(jobStatus.options).forEach(opt => {
        if (opt.value.toLowerCase() === "completed") {
            completedOption = opt;
        }
    });

    function toggleCompletedOption() {
        if (complainInput.value.trim() === "") {
            completedOption.disabled = true;
        } else {
            completedOption.disabled = false;
        }
    }

    // Run once on page load
    toggleCompletedOption();

    // Run every time complain number changes
    complainInput.addEventListener("input", toggleCompletedOption);
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const complainNumberInput = document.querySelector('input[name="complain_number"]');
    const completedOption = document.querySelector('#job_status option[value="Completed"]');

    if (complainNumberInput && completedOption) {
        complainNumberInput.addEventListener('input', function() {
            completedOption.disabled = complainNumberInput.value.trim() === '';
        });
    }
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const serialInput = document.querySelector('input[name="outdoor_serial"]');
    serialInput.addEventListener("input", function() {
        const serialValue = serialInput.value.trim();
        if (serialValue.length === 0) {
            serialInput.style.backgroundColor = ""; // reset
            return;
        }

        fetch("check_serial.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "serial=" + encodeURIComponent(serialValue)
        })
        .then(response => response.text())
        .then(data => {
            if (data === "exists") {
                serialInput.style.backgroundColor = "#add8e6"; // light blue
            } else {
                serialInput.style.backgroundColor = ""; // reset to default
            }
        });
    });
});
</script>
<!-- Popup Modal -->
<div id="complainModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
  <div style="background:#fff; padding:20px; border-radius:10px; width:300px; text-align:center;">
    <h5>Enter Complain ID</h5>
    <input type="text" id="complainInput" class="form-control mb-3" placeholder="Complain ID">
    <button id="okBtn" class="btn btn-success w-100">OK</button>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const jobStatus = document.getElementById("job_status");
    const modal = document.getElementById("complainModal");
    const okBtn = document.getElementById("okBtn");
    const complainInput = document.getElementById("complainInput");
    const submitBtn = document.getElementById("submitBtn");

    // Jab dropdown ka value change ho
    jobStatus.addEventListener("change", function() {
        if (jobStatus.value === "Completed") {
            modal.style.display = "flex"; // popup show
            submitBtn.disabled = true;    // disable submit
        } else {
            submitBtn.disabled = false;   // other options par enable
        }
    });

    // Jab OK button pe click ho
    okBtn.addEventListener("click", function() {
        if (complainInput.value.trim() !== "") {
            modal.style.display = "none";     // hide modal
            submitBtn.disabled = false;       // enable submit
        } else {
            alert("Please enter Complain ID!");
        }
    });
});
</script>

</body>
</html>

<?php $dropdown_conn->close(); ?>
