<?php 
include "db_donation.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $donor_name = $_POST['donor-name'];
    $donor_email = $_POST['donor-email'];
    $donor_password = $_POST['donor-password'];

    // Check if email already exists
    $check_sql = "SELECT * FROM donor_reg WHERE donor_email = '$donor_email'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>
                alert('This account is already registered!');
                window.location.href = 'donor_reg.php';
              </script>";
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($donor_password, PASSWORD_DEFAULT);

        // Insert data into donors table
        $sql = "INSERT INTO donor_reg (donor_name, donor_email, donor_password) 
                VALUES ('$donor_name', '$donor_email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    alert('You have registered successfully!');
                    window.location.href = 'user_login.php';
                  </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Wearables for All</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="user_login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="section-padding">
        <h2>Register</h2>
        <div class="registration-forms">
            <div class="form-box">
                <h3>Donor Registration</h3>
                <!-- Update the form action to the same file -->
                <form id="donor-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label for="donor-name">Name:</label>
                        <input type="text" id="donor-name" name="donor-name" required>
                    </div>
                    <div class="form-group">
                        <label for="donor-email">Email:</label>
                        <input type="email" id="donor-email" name="donor-email" required>
                    </div>
                    <div class="form-group">
                        <label for="donor-password">Password:</label>
                        <input type="password" id="donor-password" name="donor-password" required>
                    </div>
                    <button type="submit" class="cta">Register as Donor</button>
                </form>
                <br>
                <!-- Add "Already have an account?" message here -->
                <p>Already have an account? <a href="user_login.php">Login here</a>.</p>
            </div>
        </div>
    </section>

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
