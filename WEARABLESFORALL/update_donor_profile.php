<?php
// Database connection
include('db_donation.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch donor data
    $query = "SELECT * FROM donor_reg WHERE donor_id = $id";
    $result = mysqli_query($conn, $query);
    $donor = mysqli_fetch_assoc($result);

    if (isset($_POST['update'])) {
        // Fetching values from the form
        $donor_name = $_POST['donor_name'];
        $donor_email = $_POST['donor_email'];
        $donor_password = $_POST['donor_password'];

        // Updating donor data
        $update_query = "UPDATE donor_reg SET donor_name='$donor_name', donor_email='$donor_email', donor_password='$donor_password' WHERE donor_id = $id";
        mysqli_query($conn, $update_query);

        // Success message and redirection
        echo "<script>alert('Donor information updated successfully!');</script>";
        // echo "<script>window.location.href='admin_dashboard.php';</script>";
    }
}
?>