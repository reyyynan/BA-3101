<?php
session_start(); // Start the session

// Check if the user is logged in and is a recipient
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['donor_id'])) {
    header("Location: user_login.php"); // Redirect to login page if not logged in or not a recipient
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard - Wearables for All</title>
    <style>
       /* General styling */
       body {
            font-family: Arial, sans-serif;
            background-image: url('donategoods.jpg');
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
            background-blend-mode: darken;
            background-size: cover;
            background-position: bottom;
            background-repeat: no-repeat;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: rgba(0, 0, 0, 0.281);
            padding: 20px;
        }
        header nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            text-align: left;
            font-size: 26px;
        }
        header nav ul li {
            display: inline;
            margin-right: 20px;
        }
        header nav ul li a {
            color: white;
            text-decoration: none;
        }
        nav ul li a:hover {
            color: #dfb37d; /* Orange hover effect */
        }

        h2, h3 {
            text-align: center;
            margin-top: 20px;
            color: white;
        }

        p{
            color: white;
        }
        /* Category buttons with background images and text overlay */
        .category-buttons {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        .category-btn {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 20px;
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
        .category-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
            border-radius: 10px;
            z-index: 1;
        }
        .category-btn span {
            position: relative;
            z-index: 2; /* Bring text above the overlay */
        }
        .category-btn:hover {
            transform: scale(1.05);
        }
        .category-shoes {
            background-image: url('shoes.png');
            background-color: white;
        }
        .category-clothes {
            background-image: url('clothes.png');
            background-color: white;
        }
        .category-bags {
            background-image: url('bag.png');
            background-color: white;
        }
        /* Donation form styling */
        .form-group {
            margin: 20px auto;
            max-width: 500px;
            text-align: left;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .cta {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #f7941d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .cta:hover {
            background-color: #e67817;
        }
        /* Pickup/Dropoff Section */
        .pickup-dropoff {
            text-align: center;
            margin-top: 120px;
        }
        .pickup-dropoff button {
            padding: 10px 20px;
            background-color: #f7941d;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .pickup-dropoff button:hover {
            background-color: #f56316;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            margin-top: 50px;
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
<body>

    <header>
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li> <!-- Link to the logout page -->
            </ul>
        </nav>
    </header>

    <h2>Welcome to the Donor Dashboard</h2>
    <h3>Choose a category to donate</h3>

    <!-- Category Buttons Section -->
    <div class="category-buttons">
        <a href="donate_shoes.php" class="category-btn category-shoes">
            <span>Donate Shoes</span>
        </a>
        <a href="donate_clothes.php" class="category-btn category-clothes">
            <span>Donate Clothes</span>
        </a>
        <a href="donate_bags.php" class="category-btn category-bags">
            <span>Donate Bags</span>
        </a>
    </div>

    <!-- Pickup or Drop-off Scheduling Section -->
    <section class="pickup-dropoff">
        <h3>Schedule Pickup or Drop-off</h3>
        <p>You can schedule a pickup or drop off for your donated items.</p>
        <button onclick="window.location.href='schedule_pickup.php'">Schedule Pickup</button>
        <button onclick="window.location.href='schedule_dropoff.php'">Schedule Drop-off</button>
    </section>

    <footer>
        <p>&copy; 2024 Wearables for All. All Rights Reserved.</p>
    </footer>

</body>
</html>
