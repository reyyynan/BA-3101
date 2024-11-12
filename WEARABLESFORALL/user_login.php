<?php
// Database connection
include "db_donation.php";

session_start(); // Start session

// Clear any existing session data
if (isset($_SESSION['donor_id']) || isset($_SESSION['recipient_id']) || isset($_SESSION['admin_id'])) {
    session_unset(); // Clear the session data
    session_destroy(); // Destroy the session
    session_start(); // Start a new session
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // Using 'username' to accommodate both admin username and donor/recipient emails
    $password = $_POST['password'];

    // First, check if the user is an admin
    $admin_sql = "SELECT * FROM admin WHERE username = '$username'";
    $admin_result = $conn->query($admin_sql);

    if ($admin_result && $admin_result->num_rows > 0) {
        // Admin account found
        $admin_data = $admin_result->fetch_assoc();

        // Verify password for admin
        if (password_verify($password, $admin_data['password'])) {
            // Admin login successful
            $_SESSION['loggedin'] = true;  // Set loggedin to true
            $_SESSION['admin_id'] = $admin_data['admin_id'];
            $_SESSION['admin_name'] = $admin_data['username'];

            echo "<script>
                    alert('Admin login successful!');
                    window.location.href = 'admin_dashboard.php';
                  </script>";
            exit; // Stop further execution after successful admin login
        } else {
            echo "<script>
                    alert('Invalid username or password. Please try again.');
                    window.location.href = 'user_login.php';
                  </script>";
            exit;
        }
    }

    // Check if the user exists in donor_reg or recipient_reg tables
    $donor_sql = "SELECT * FROM donor_reg WHERE donor_email='$username'";
    $recipient_sql = "SELECT * FROM recipient_reg WHERE recipient_email='$username'";

    $donor_result = $conn->query($donor_sql);
    $recipient_result = $conn->query($recipient_sql);

    if ($donor_result && $donor_result->num_rows > 0) {
        // Donor found, fetch the data
        $donor_data = $donor_result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $donor_data['donor_password'])) {
            // Donor login successful
            $_SESSION['loggedin'] = true;  // Set loggedin to true
            $_SESSION['donor_id'] = $donor_data['donor_id'];
            $_SESSION['donor_name'] = $donor_data['donor_name'];

            echo "<script>
                    alert('Login successful!');
                    window.location.href = 'donor_dashboard.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Invalid email or password. Please try again.');
                    window.location.href = 'user_login.php';
                  </script>";
        }
    } elseif ($recipient_result && $recipient_result->num_rows > 0) {
        // Recipient found, fetch the data
        $recipient_data = $recipient_result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $recipient_data['recipient_password'])) {
            // Recipient login successful
            $_SESSION['loggedin'] = true;  // Set loggedin to true
            $_SESSION['recipient_id'] = $recipient_data['recipient_id'];
            $_SESSION['recipient_name'] = $recipient_data['recipient_name'];

            echo "<script>
                    alert('Login successful!');
                    window.location.href = 'recipient_dashboard.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Invalid email or password. Please try again.');
                    window.location.href = 'user_login.php';
                  </script>";
        }
    } else {
        // User not found
        echo "<script>
                alert('Invalid username or password. Please try again.');
                window.location.href = 'user_login.php';
              </script>";
    }

    // Close connection
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wearables for All</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>
                    <a href="#register" class="dropdown-toggle">Register</a>
                    <ul class="dropdown">
                        <li><a href="donor_reg.php">Register as Donor</a></li>
                        <li><a href="recipient_reg.php">Register as Recipient</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <section class="section-padding">
        <h2>Login</h2>
        <div class="form-box">
            <form id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="username">Email:</label>
                    <input id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="cta">Login</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Wearables for All. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
