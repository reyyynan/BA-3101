<?php

session_start(); // Start the session

// Check if the user is logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['admin_id'])) {
    header("Location: user_login.php"); // Redirect to the admin login page if not logged in
    exit;
}

// Database connection
include('db_donation.php');

$query = "SELECT * FROM donor_reg";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor List</title>
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
            margin-top: 20px;
        }

        /* Styling the table layout */
        .donor-list-table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%; /* Adjusted width for better visibility */
            background-color: rgba(247, 148, 29, 0.8); /* Semi-transparent background */
            border-radius: 10px; /* Rounded corners */
            overflow: hidden; /* To make rounded corners effective */
            margin-top: 80px;
        }

        .donor-list-table th, .donor-list-table td {
            padding: 10px;
            text-align: left;
        }

        .donor-list-table th {
            background-color: #f7941d; /* Header color */
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
        }

          /* Action buttons for Edit and Delete */
        .btn-action {
            padding: 8px 12px;
            text-decoration: none;
            color: white;
            background-color: #f7941d;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 14px;
            margin-right: 5px;
    }

         /* Hover effect for action buttons */
            .btn-action:hover {
                background-color: #e67817; /* Darker shade for hover */
            }

        .action-links a {
            color: white; /* Link color */
            text-decoration: none; /* No underline */
           
        }
        
    </style>
</head>
<body>

<h2 style="text-align: center;">Donor List</h2>

<table class="donor-list-table" border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?php echo $row['donor_id']; ?></td>
        <td><?php echo $row['donor_name']; ?></td>
        <td><?php echo $row['donor_email']; ?></td>
        <td><?php echo $row['donor_password']; ?></td>
        <td class="action-links">
        <a href="edit_donor.php?donor_id=<?php echo $row['donor_id']; ?>" class="btn-action">Edit</a>
        <a href="delete_donor.php?donor_id=<?php echo $row['donor_id']; ?>" class="btn-action" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- Back to Admin Dashboard Button -->
<br>
<div class="button-container">
    <form action="admin_dashboard.php">
        <button type="submit" class="btn-back">Back</button>
    </form>
</div>

</body>
</html>
