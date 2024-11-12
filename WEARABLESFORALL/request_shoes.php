<?php
session_start(); // Start the session

// Check if the user is logged in as a recipient
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['recipient_id'])) {
    header("Location: user_login.php"); // Redirect to login page if not logged in
    exit;
}

include "db_donation.php"; // Include the database connection

// Process the request form if submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_request'])) {
    // Ensure all necessary POST variables are set
    if (!isset($_POST['name'], $_POST['contact'], $_POST['email'], $_POST['item_type'], $_POST['size_or_type'], $_POST['condition'], $_POST['quantity'], $_POST['pickup_dropoff'])) {
        echo "<script>alert('Please fill in all required fields.');</script>";
        exit;
    }

    // Prepare the SQL statement for item requests
    $stmt = $conn->prepare("INSERT INTO item_requests (recipient_id, name, contact_number, email, item_type, size_or_type, condition_preference, quantity, pickup_dropoff) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    // Bind parameters and set values
    $recipient_id = $_SESSION['recipient_id'];
    $name = $_POST['name'];
    $contact_number = $_POST['contact'];
    $email = $_POST['email'];
    $item_type = $_POST['item_type'];
    $size_or_type = $_POST['size_or_type'];
    $condition_preference = $_POST['condition'];
    $quantity = $_POST['quantity'];
    $pickup_dropoff = $_POST['pickup_dropoff'];

    // Check if quantity is a valid number
    if (!is_numeric($quantity) || $quantity < 1) {
        echo "<script>alert('Please enter a valid quantity.');</script>";
        exit;
    }

    $stmt->bind_param("issssssss", $recipient_id, $name, $contact_number, $email, $item_type, $size_or_type, $condition_preference, $quantity, $pickup_dropoff);

    if ($stmt->execute()) {
        echo "<script>alert('Request submitted successfully.'); window.location.href = 'recipient_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

// Retrieve available donations for display
$donations = $conn->query("SELECT * FROM item_requests");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Items - Wearables for All</title>
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

<!-- Request Form -->
<div class="form-container_request-items">
    <h2>Request Items</h2>
    <form action="request_shoes.php" method="POST">
        <input type="hidden" name="submit_request" value="1">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="contact">Contact Number</label>
            <input type="tel" id="contact_request-shoes" name="contact" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="item_type">Item Type Needed</label>
            <select id="item_type" name="item_type" required>
                <option value="Shoes">Shoes</option>
                <option value="Bags">Bags</option>
                <option value="Clothes">Clothes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="size_or_type">Size or Type</label>
            <input type="text" id="size_or_type" name="size_or_type">
        </div>
        <div class="form-group">
            <label for="condition">Condition Preference</label>
            <select id="condition" name="condition">
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity Needed</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
        </div>
        <div class="form-group">
            <label for="pickup_dropoff">Pickup/Drop-off Preference</label>
            <select id="pickup_dropoff" name="pickup_dropoff">
                <option value="pickup">Pickup</option>
                <option value="dropoff">Drop-off</option>
            </select>
        </div>
        <button type="submit">Submit Request</button>
        <button type="button" class="cancel-btn_donate-shoes" onclick="window.location.href='recipient_dashboard.php'">Cancel</button>
    </form>
</div>
          <option value="new">New</option>
                <option value="gently_used">Gently Used</option>
                <option value="no_preference">No Preference</option>
      



<!-- Notification and Updates Form -->
<div class="notification-form">
    <h2>Notification Preferences</h2>
    <form action="update_notifications.php" method="POST">
        <div class="form-group">
            <label for="notification_preferences">Notify me when specific items become available:</label>
            <input type="text" id="notification_preferences" name="notification_preferences" placeholder="e.g., Shoes, Size 10">
        </div>
        <div class="form-group">
            <label for="contact_update">Update Contact Details</label>
            <input type="tel" id="contact_update" name="contact_update">
        </div>
        <button type="submit">Save Preferences</button>
    </form>
</div>

<footer>
    <div class="container">
        <p>&copy; 2024 Wearables for All. All Rights Reserved.</p>
    </div>
</footer>

</body>
</html>
