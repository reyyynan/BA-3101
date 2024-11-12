<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include('db_donation.php');

if (isset($_GET['recipient_id'])) {
    $id = $_GET['recipient_id'];

    // Delete recipient
    $query = "DELETE FROM recipient_reg WHERE recipient_id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // If delete was successful, show an alert and redirect
        echo "<script>
            alert('Recipient information deleted successfully!');
            window.location.href='view_recipient.php';
        </script>";
    } else {
        // If there was an issue with the deletion, show error message
        echo "<script>
            alert('Error deleting recipient information.');
            window.location.href='view_recipient.php';
        </script>";
    }
} else {
    // If recipient_id is not set in the URL, redirect to view_recipients.php
    echo "<script>
        alert('Invalid request.');
        window.location.href='view_recipient.php';
    </script>";
}
?>
