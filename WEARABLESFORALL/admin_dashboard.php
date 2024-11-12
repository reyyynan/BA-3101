<?php
session_start(); // Start the session

// Check if the user is logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['admin_id'])) {
    header("Location: user_login.php"); // Redirect to the admin login page if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Wearables for All</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Header Section -->
    <header>
        <div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Admin Dashboard Section -->
    <section id="admin-dashboard" class="section-padding">
        <div class="container">
            <h2>Admin Dashboard</h2>

            <!-- Manage Donations Section -->
            <div id="donations">
                <h3 class="donationh3">Manage Donations</h3>
                <p class="donationp">View and manage all donations here.</p>
                <button class="cta">View Donations</button>
                <button class="cta">Edit Donations</button>
            </div>

            <!-- Manage Recipients Section -->
            <div id="recipients" style="margin-top: 30px;">
                <h3 class="donationh3">Manage Recipients</h3>
                <p class="donationp">View and manage all recipient requests here.</p>
                <button class="cta">View Recipients</button>
                <button class="cta">Edit Recipients</button>
            </div>

            <!-- Manage Donors Section -->
          <div id="donors" style="margin-top: 30px;">
            <h3 class="donationh3">Manage Donors</h3>
            <p class="donationp">View and manage all donors here.</p>
            <br>
            <a href="view_donors.php" class="cta">Manage Donor Info</a>
            <!-- <a href="edit_donor.php" class="cta">Edit Donors</a>
            <a href="delete_donor.php" class="cta">Delete Donor</a> -->
        </div>

        <!-- Manage Recipients Info Section -->
        <div id="recipients-info" style="margin-top: 30px;">
            <h3 class="donationh3">Manage Recipients Info</h3>
            <p class="donationp">View and manage recipients' information.</p>
            <br>
            <a href="view_recipient.php" class="cta"> Manage Recipient Info</a>
            <!-- <a href="edit_recipient.php" class="cta">Edit Recipient Info</a>
            <a href="delete_recipient.php" class="cta">Delete Recipient</a> -->
        </div>

    </section>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Wearables for All. All Rights Reserved.</p>
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
            </ul>
        </div>
    </footer>
</body>

</html>
