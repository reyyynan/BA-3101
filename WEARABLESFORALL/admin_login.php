
<?php include "db_donation.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Wearables for All</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Header Section -->
  <header>
    <div class="container">
     
      </div>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Admin Login Section -->
  <section id="admin-login" class="section-padding">
    <div class="container">
      <h2>Admin Login</h2>
      <div class="form-box">
        <!-- Make sure the form uses POST method and connects to your PHP file -->
        <form id="admin-login-form" action="admin_login.php" method="POST">
          <div class="form-group">
            <label for="admin-username">Username:</label>
            <input type="text" id="admin-username" name="username" required>
          </div>
          <div class="form-group">
            <label for="admin-password">Password:</label>
            <input type="password" id="admin-password" name="password" required>
          </div>
          <button type="submit" class="cta">Login</button>
        </form>
      </div>
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


<?php




// Include the database connection file

include "db_donation.php"; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Collect form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare SQL query to select the hashed password based on username
  $sql = "SELECT password FROM admin WHERE username = ?";

  // Prepare and bind
  if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("s", $username);

      // Execute the statement
      $stmt->execute();

      // Store the result
      $stmt->store_result();

      // Check if the username exists
      if ($stmt->num_rows > 0) {
          // Bind the result to a variable
          $stmt->bind_result($stored_password);
          $stmt->fetch();

          // Verify the entered password with the hashed password from the database
          if (password_verify($password, $stored_password)) {
              // Password is correct, login successful
              echo "<script>alert('Login successful!');</script>";
              // Redirect to the admin dashboard
              header("Location: admin_dashboard.php");
              exit(); // Ensure no further code is executed after redirection
          } else {
              // Invalid password
              echo "<script>alert('Invalid credentials.');</script>";
          }
      } else {
          // Invalid username
          echo "<script>alert('Invalid credentials.');</script>";
      }

      // Close statement
      $stmt->close();
  } else {
      // Error preparing statement
      echo "Error preparing statement: " . $conn->error;
  }

  // Close the database connection
  $conn->close();
}

?>

