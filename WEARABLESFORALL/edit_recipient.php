<?php

session_start(); // Start the session

// Check if the user is logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['admin_id'])) {
    header("Location: user_login.php"); // Redirect to the admin login page if not logged in
    exit;
}

// Database connection
include('db_donation.php');

if (isset($_GET['recipient_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['recipient_id']); // Avoid SQL injection

    // Fetch donor data using correct column names from your database
    $query = "SELECT * FROM recipient_reg WHERE recipient_id = $id";
    $result = mysqli_query($conn, $query);
    $recipient = mysqli_fetch_assoc($result);

    // Check if the update button is clicked
    if (isset($_POST['update'])) {
        // Fetching values from the form
        $recipient_name = mysqli_real_escape_string($conn, $_POST['recipient_name']);
        $recipient_email = mysqli_real_escape_string($conn, $_POST['recipient_email']);
        $recipient_password = mysqli_real_escape_string($conn, $_POST['recipient_password']);

        // Check if the email already exists for a different donor
        $check_query = "SELECT * FROM recipient_reg WHERE recipient_email = '$recipient_email' AND recipient_id != $id";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // Email is already in use by another donor
            echo "<script>alert('This email is already registered with another account!'); window.location.href='edit_recipient.php?recipient_id=$id';</script>";
        } else {
            // Rehash the password before updating (only if a new password is provided)
            $hashed_password = password_hash($recipient_password, PASSWORD_DEFAULT);

            // SQL query to update donor data, including the rehashed password
            $update_query = "UPDATE recipient_reg SET recipient_name='$recipient_name', recipient_email='$recipient_email', recipient_password='$hashed_password' WHERE recipient_id = $id";
            
            if (mysqli_query($conn, $update_query)) {
                // Alert message for successful update using JavaScript
                echo "<script>alert('Recipient details updated successfully!'); window.location.href='view_recipient.php';</script>";
            } else {
                echo "Error updating recipient: " . mysqli_error($conn);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipient</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
           /* Apply a background image to the body */
           body {
            height: 80vh; /* Full viewport height */
            background-image: url('donategoods.jpg');
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
            background-blend-mode: darken;
            background-size: cover;
            background-position: bottom;
            background-repeat: no-repeat;
            color: white; /* Set default text color to white for better contrast */
            font-family: Arial, sans-serif; /* Use a clean font */
            margin-top: 80px;
        }
        /* Styling the table layout for the form */
        .edit-recipient-table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 60%;
            background-color: rgba(247, 148, 29, 0.8); /* Semi-transparent background */
        }
        .edit-recipient-table th, .edit-recipient-table td {
            padding: 10px;
            text-align: left;
        }
        .edit-recipient-table th {
            background-color: transparent;
        }
        .edit-recipient-table td input {
            width: 100%;
            padding: 8px;
            margin: 4px 0;
            box-sizing: border-box;
            background-color: transparent;
        }
        .button-container {
            text-align: center;
        }
        .btn-back {
            padding: 8px 12px;
            background-color: #f7941d;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            margin-left: 70;
        }
        button[type="submit"] {
            background-color: #f7941d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- Recipient Edit Form -->
<h2 style="text-align: center;">Edit Recipient</h2>
<form method="POST">
    <table class="edit-recipient-table" border="1">
        <tr>
            <th>Name</th>
            <td>
                <input type="text" name="recipient_name" value="<?php echo isset($recipient['recipient_name']) ? $recipient['recipient_name'] : ''; ?>" required>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                <input type="email" name="recipient_email" value="<?php echo isset($recipient['recipient_email']) ? $recipient['recipient_email'] : ''; ?>" required>
            </td>
        </tr>
        <tr>
            <th>Password</th>
            <td>
                <input type="password" name="recipient_password" value="<?php echo isset($recipient['recipient_password']) ? $recipient['recipient_password'] : ''; ?>" required>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <button type="submit" name="update">Update</button>
            </td>
        </tr>
    </table>
</form>

<!-- Back to Admin Dashboard Button -->
<br>
<div class="button-container">
    <form action="admin_dashboard.php">
        <button type="submit" class="btn-back">Back</button>
    </form>
</div>
</body>
</html>
