<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['donor_id'])) {
    header("Location: user_login.php"); // Redirect to login page if not logged in
    exit;
}

include "db_donation.php"; // Include the database connection

// Only process the form if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO shoes_donation (donor_id, name, contact_number, email, size_category, `condition`, quantity, pickup_dropoff, schedule_datetime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if prepare() was successful
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    // Set parameters and bind
    $donor_id = $_SESSION['donor_id']; // Get the donor ID from session
    $name = $_POST['name'];
    $contact_number = $_POST['contact'];
    $email = $_POST['email'];
    $size_category = $_POST['size'];
    $condition = $_POST['condition'];
    $quantity = $_POST['quantity'];
    $pickup_dropoff = $_POST['pickup_dropoff'];
    $schedule_datetime = $_POST['scheduleDateTime'];

   // Bind parameters
$stmt->bind_param("issssssss", $donor_id, $name, $contact_number, $email, $size_category, $condition, $quantity, $pickup_dropoff, $schedule_datetime);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>alert('Donation submitted successfully. Thank you for the donation!'); window.location.href = 'donor_dashboard.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "');</script>";
}

// Close connections
$stmt->close();
$conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Shoes - Wearables for All</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="form-container_donate-shoes">
    <h2 class="donate-shoes_h2">Donate Shoes</h2>
    <form action="donate_shoes.php" method="POST">
        <div class="form-group_donate-shoes">
            <label class="donate-shoes_label" for="name">Full Name</label>
            <input class="donate-shoes_input" type="text" id="name" name="name" required>
        </div>
        <div class="form-group_donate-shoes">
            <label class="donate-shoes_label" for="contact">Contact Number</label>
            <input class="donate-shoes_input" type="tel" id="contact_donate-shoes" name="contact" required>
        </div>
        <div class="form-group_donate-shoes">
            <label class="donate-shoes_label" for="email">Email</label>
            <input class="donate-shoes_input" type="email" id="email" name="email" required>
        </div>
        <div class="form-group_donate-shoes">
            <label class="donate-shoes_label" for="size">Shoe Size Category</label>
            <select id="size" name="size" class="donate-shoes_select" required>
                <option value="" disabled selected>Select Size Category</option>
                <option value="kids">Kids</option>
                <option value="teens">Teens</option>
                <option value="adults">Adults</option>
            </select>
        </div>
        <div class="form-group_donate-shoes">
            <label class="donate-shoes_label" for="condition">Condition of Shoes</label>
            <select id="condition" name="condition" class="donate-shoes_select" required>
                <option value="" disabled selected>Select Condition</option>
                <option value="new">New</option>
                <option value="gently_used">Gently Used</option>
                <option value="used">Used</option>
            </select>
        </div>
        <div class="form-group_donate-shoes">
            <label class="donate-shoes_label" for="quantity">Quantity (Pieces/Bulk)</label>
            <select id="quantity" name="quantity" class="donate-shoes_select" required>
                <option value="" disabled selected>Select Quantity</option>
                <option value="1">1 Piece</option>
                <option value="2-5">2-5 Pieces</option>
                <option value="6-10">6-10 Pieces</option>
                <option value="bulk">Bulk (10+)</option>
            </select>
        </div>
        <div class="form-group_donate-shoes">
            <label class="donate-shoes_label" for="pickup_dropoff">Pickup or Drop-off</label>
            <select id="pickup_dropoff" name="pickup_dropoff" class="dropoff-select_donate-shoes" required>
                <option value="" disabled selected>Select an option</option>
                <option value="pickup">Pickup</option>
                <option value="dropoff">Drop-off</option>
            </select>
        </div>
        <div class="form-group_donate-shoes">
            <button type="button" class="schedule-btn_donate_shoes" onclick="openModal()">Schedule Pickup/Drop-off</button>
        </div>

        <!-- Modal for Scheduling -->
        <div id="scheduleModal" class="donate-shoes-modal">
            <div class="donate-shoes-modal-content">
                <span class="donate-shoes-close" onclick="closeModal()">&times;</span>
                <h2>Schedule Pickup/Drop-off</h2>
                <p>Select a date and time for your pickup or drop-off:</p>
                <input type="datetime-local" id="scheduleDateTime" name="scheduleDateTime" required>
                <button type="button" onclick="confirmSchedule()">Confirm</button>
            </div>
        </div>

        <button type="submit" class="submit-btn_donate-shoes">Submit</button>
        <button type="button" class="cancel-btn_donate-shoes" onclick="window.location.href='donor_dashboard.php'">Cancel</button>
    </form>
</div>

<footer>
    <div class="container">
        <p>&copy; 2024 Wearables for All. All Rights Reserved.</p>
    </div>
</footer>

<script>
    // Open and close the modal
    function openModal() {
        document.getElementById("scheduleModal").style.display = "block";
    }
    function closeModal() {
        document.getElementById("scheduleModal").style.display = "none";
    }
    function confirmSchedule() {
        const dateTime = document.getElementById("scheduleDateTime").value;
        if (dateTime) {
            alert(`Scheduled for: ${dateTime}`);
            closeModal();
        } else {
            alert("Please select a date and time.");
        }
    }
    window.onclick = function(event) {
        const modal = document.getElementById("scheduleModal");
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

</body>
</html>
