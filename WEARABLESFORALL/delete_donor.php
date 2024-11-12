<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include('db_donation.php');

if (isset($_GET['donor_id'])) {
    $id = $_GET['donor_id'];

    // Delete donor
    $query = "DELETE FROM donor_reg WHERE donor_id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // If delete was successful, show an alert and redirect
        echo "<script>
            alert('Donor information deleted successfully!');
            window.location.href='view_donors.php';
        </script>";
    } else {
        // If there was an issue with the deletion, show error message
        echo "<script>
            alert('Error deleting donor information.');
            window.location.href='view_donors.php';
        </script>";
    }
} else {
    // If donor_id is not set in the URL, redirect to view_donors.php
    echo "<script>
        alert('Invalid request.');
        window.location.href='view_donors.php';
    </script>";
}
?>


