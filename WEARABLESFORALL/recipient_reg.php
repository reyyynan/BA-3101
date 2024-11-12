<?php 
include "db_donation.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $recipient_name = $_POST['recipient-name'];
    $recipient_email = $_POST['recipient-email'];
    $recipient_password = $_POST['recipient-password'];


    // Check if email already exists
    $check_sql = "SELECT * FROM recipient_reg WHERE recipient_email = '$recipient_email'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>
                alert('This account is already registered!');
                window.location.href = 'recipient_reg.php';
              </script>";
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($recipient_password, PASSWORD_DEFAULT);

        // Insert data into donors table
        $sql = "INSERT INTO recipient_reg (recipient_name, recipient_email, recipient_password) 
                VALUES ('$recipient_name', '$recipient_email', '$hashed_password')";

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
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
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
                <h3>Recipient Registration</h3>
                <!-- Update the form action to the same file -->
                <form id="recipient-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="form-group">
                        <label for="recipient-name">Name:</label>
                        <input type="text" id="recipient-name" name="recipient-name" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-email">Email:</label>
                        <input type="email" id="recipient-email" name="recipient-email" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-password">Password:</label>
                        <input type="password" id="recipient-password" name="recipient-password" required>
                    </div>
                    <button type="submit" class="cta">Register as Recipient</button>
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