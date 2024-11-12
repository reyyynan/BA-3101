<?php
session_start(); // Start the session

// Check if the user is logged in and is a recipient
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['recipient_id'])) {
    header("Location: user_login.php"); // Redirect to login page if not logged in or not a recipient
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipient Dashboard - Wearables for All</title>
  <style>
    /* General Styles */
    .body-recipient {
      font-family: Arial, sans-serif;
      background-image: url('donategoods.jpg');
      background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
      background-blend-mode: darken;
      background-size: cover;
      background-position: bottom;
      background-repeat: no-repeat;
      margin: 0;
      padding: 0;
    }

    /* Header */
    .header-recipient {
      background-color: rgba(0, 0, 0, 0.281); /* Transparent header */
      padding: 20px 0;
      width: 100%;
      margin-bottom: 50px; /* Add space below the header */
    }
    .header-recipient nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      text-align: left;
    }
    .header-recipient nav ul li {
      display: inline;
      margin-right: 20px;
    }
    .header-recipient nav ul li a {
      color: white;
      text-decoration: none;
      padding: 10px 15px; /* Add padding around the links */
      transition: color 0.3s ease; /* Smooth transition */
      font-size: 26px;

    }

    nav ul li a:hover {
            color: #dfb37d; /* Orange hover effect */
        }

    /* Dashboard Section */
    .dashboard-section {
      text-align: center;
      margin-top: 20px;
    }

    .dashboard-section h2, .dashboard-section p {
      margin-top: 20px;
      color: white;
    }

    /* Category Buttons */
    .category-buttons-recipient {
      display: flex;
      justify-content: center;
      margin-top: 30px;
    }

    .category-btn-recipient {
      position: relative;
      width: 200px;
      height: 200px;
      margin: 0 20px;
      background-color: white;
      background-size: cover;
      background-position: center;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: white;
      font-size: 18px;
      font-weight: bold;
      transition: transform 0.3s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }
    .category-btn-recipient::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      border-radius: 10px;
      z-index: 1;
    }
    .category-btn-recipient span {
      position: relative;
      z-index: 2;
    }
    .category-btn-recipient:hover {
      transform: scale(1.05);
    }

    /* Category-Specific Styles */
    .category-clothes {
      background-image: url('clothes.png');
    }
    .category-shoes {
      background-image: url('shoes.png');
    }
    .category-bags {
      background-image: url('bag.png');
    }

    /* Request Form Section */
    .request-form-recipient {
      margin-top: 50px;
      text-align: center;
    }

    .request-form-recipient h3 {
      font-size: 24px;
      margin-bottom: 20px;
      color: white;
    }

    .request-form-recipient form {
      max-width: 400px;
      margin: 0 auto;
    }

    .form-group-recipient {
      margin-bottom: 15px;
      color: white;
    }

    .form-control-recipient {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .cta-recipient {
      background-color: #f7941d;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
      font-size: 16px;
      margin-bottom: 100px;
    }
    .cta-recipient:hover {
      background-color: #e67817;
    }

  
html,
body {
    height: 100%;
    /* Full height */
    margin: 0;
    /* Remove default margins */
}

body {
    display: flex;
    flex-direction: column;
    /* Arrange header, content, and footer in a column */
}

footer {
    background-color: #333;
    /* Footer background color */
    color: white;
    /* Footer text color */
    padding: 50px 0;
    /* Footer padding */
    text-align: center;
    /* Center the text */
    margin-top: auto;
    /* Push footer to the bottom */
}

footer ul {
    list-style: none;
    /* Remove bullet points */
    display: flex;
    /* Use flexbox for layout */
    justify-content: center;
    /* Center items */
}

footer ul li {
    margin: 0 5px;
    /* Space between list items */
}

footer ul li a {
    color: white;
    /* Link color */
    text-decoration: none;
    /* Remove underline */
}
  </style>
</head>
<body class="body-recipient">

  <header class="header-recipient">
    <nav>
      <ul>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <section class="dashboard-section">
    <h2>Recipient Dashboard</h2>
    <p>Welcome, Recipient! You can now request items from various categories.</p>

    <!-- Category Buttons Section -->
    <div class="category-buttons-recipient">
      <a href="request_clothes.php" class="category-btn-recipient category-clothes">
        <span>Request Clothes</span>
      </a>
      <a href="request_shoes.php" class="category-btn-recipient category-shoes">
        <span>Request Shoes</span>
      </a>
      <a href="request_bags.php" class="category-btn-recipient category-bags">
        <span>Request Bags</span>
      </a>
    </div>

    <!-- Request Form Section -->
    <section class="request-form-recipient">
      <h3>Request an Item</h3>
      <form method="POST" action="submit_request.php">
        <div class="form-group-recipient">
          <label for="item_category">Select Category:</label>
          <select id="item_category" name="item_category" class="form-control-recipient" required>
            <option value="Clothes">Clothes</option>
            <option value="Shoes">Shoes</option>
            <option value="Bags">Bags</option>
          </select>
        </div>
        <div class="form-group-recipient">
          <label for="item_details">Item Details:</label>
          <textarea id="item_details" name="item_details" class="form-control-recipient" placeholder="Describe the item you are requesting" required></textarea>
        </div>
        <button type="submit" class="cta-recipient">Submit Request</button>
      </form>
    </section>
    
    <!-- Simple Message after Request -->
    <script>
      // Simple message for request submission (can be improved with server-side processing)
      const requestForm = document.querySelector('form');
      requestForm.addEventListener('submit', function(event) {
        event.preventDefault();
        alert('Your request has been submitted. We will notify you when it is available.');
        // In a real application, this should be followed by form submission to the server.
        // requestForm.submit(); // Uncomment this when backend is ready
      });
    </script>

  </section>

  <footer class="footer-recipient">
    <div class="container">
      <p>&copy; 2024 Wearables for All. All Rights Reserved.</p>
      <ul>
        
