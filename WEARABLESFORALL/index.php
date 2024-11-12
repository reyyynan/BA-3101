<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wearables for All: Donation Hub for the Needy</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <!-- Header Section with Logo and Navigation -->
    <header>
        <div class="navbarContainer">
            <div class="logo">
                <img src="Pink Colorful Illustrated Modern Charity Foundation Logo_20241006_204213_0000.png" alt="Wearables for All Logo" id="logo-image">
            </div>

            <nav class="navbar">
                <ul>
                    <li><a href="#how-it-works">How It Works</a></li>
                    <li><a href="#donate">Donate</a></li>
                    <li><a href="user_login.php">Login</a></li>
                    <li>
                        <a href="#register" class="dropdown-toggle">Register</a>
                        <ul class="dropdown">
                            <li><a href="donor_reg.php">Register as Donor</a></li>
                            <li><a href="recipient_reg.php">Register as Recipient</a></li>
                        </ul>
                    </li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                
            </nav>
        </div>
    </header>

    
    <!-- Hero Section -->
    <section id="hero">
        <div class="hero-content">
            <h1>Wearables for All: Donation Hub for the Needy</h1>
            <p>Help make a difference by donating clothes, shoes, and bags to those in need. Together, we can create a positive impact.</p>
            <a href="#donate" class="getStartedbtn">Get Started</a>
        </div>
    </section>

    
    <!-- How It Works Section -->
    <section id="how-it-works" class="section-padding">
    <div class="howitworksContainer">
        <h2><i class="fas fa-cogs"></i> How It Works</h2>
        <div class="steps">
            <div class="step">
                <h3><i class="fas fa-list-alt"></i> 1. List Your Donations</h3>
                <p>Choose the items you'd like to donate, and we'll guide you through the simple process.</p>
            </div>
            <div class="step">
                <h3><i class="fas fa-calendar-check"></i> 2. Schedule Pick-up or Drop-off</h3>
                <p>Pick a time and place for easy pick-up, or drop your items at our nearest center.</p>
            </div>
            <div class="step">
                <h3><i class="fas fa-map-marked-alt"></i> 3. Track Your Donation</h3>
                <p>Stay updated on where your donation is going and how it is helping those in need.</p>
            </div>
        </div>
    </div>
</section>

    <!-- Donate Section -->
    <section id="donate" class="section-padding">
    <div class="donatesectionContainer">
        <h2><i class="fas fa-gift"></i> Donate Now</h2>
        <p>To donate items, please <a href="donor_reg.php" class="link">register here</a> if you haven't already.</p>
        <div class="categories">
            <div class="category">
                <h3><i class="fas fa-tshirt"></i> Clothes</h3>
                <p>Donate gently used clothes to make a difference.</p>
            </div>
            <div class="category">
                <h3><i class="fas fa-shoe-prints"></i> Shoes</h3>
                <p>Provide shoes to those in need.</p>
            </div>
            <div class="category">
                <h3><i class="fas fa-hat-cowboy"></i> Accessories</h3>
                <p>Help others with wearable accessories.</p>
            </div>
        </div>
        <a href="donor_reg.php" class="cta"><i class="fas fa-arrow-right"></i> Start Donating</a>
    </div>
</section>


    <!-- Recipient Request Section -->
    <section id="request" class="section-padding">
    <div class="form-box">
        <h2><i class="fas fa-hands-helping"></i> Request Donations</h2>
        <p>If you or someone you know is in need of clothes, shoes, or accessories, please <a href="recipient_reg.php" class="link">register here</a> to request assistance.</p>
        <form id="request-form">
            <div class="form-group">
                <label for="recipient-name">Name:</label>
                <input type="text" id="recipient-name" name="recipient-name" required>
            </div>
            <div class="form-group">
                <label for="recipient-email">Email:</label>
                <input type="email" id="recipient-email" name="recipient-email" required>
            </div>
            <div class="form-group">
                <label for="recipient-address">Address:</label>
                <input type="text" id="recipient-address" name="recipient-address" required>
            </div>
            <div class="form-group">
                <label for="recipient-needs">What do you need?</label>
                <textarea id="recipient-needs" name="recipient-needs" rows="4" required></textarea>
            </div>
            <button type="submit" class="cta">Submit Request</button>
        </form>
    </div>
</section>

    <!-- About Us Section -->
    <section id="about" class="section-padding">
        <div class="aboutusContainer">
            <h2><i class="fas fa-hands-helping"></i>About Us</h2>
            <p>Wearables for All is a community-driven platform dedicated to promoting sustainable fashion and social responsibility by connecting individuals who have surplus wearable items with those in need. Focused on the community of Lipa, Batangas, our platform makes it easy for donors to contribute clothing essentials, shoes, and accessories directly to people facing hardships. Through our platform, we aim to foster a culture of sharing and reduce waste, ensuring that wearable items find new life with those who can benefit most.

Our mission goes beyond simply providing clothing—it’s about empowering communities, promoting dignity, and fostering a sense of solidarity. We also focus on raising awareness about sustainability, encouraging people to think twice before discarding their wearable items and instead consider how they can make a positive impact on someone else's life. Our long-term vision includes expanding to other areas and offering educational resources to inspire more communities to join in creating a circular economy for clothing.
            </p>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-padding">
    <div class="form-box">
        <h2><i class="fas fa-envelope"></i> Contact Us</h2>
        <form>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message"></textarea>
            </div>
            <button type="submit" class="cta">Send Message</button>
        </form>
    </div>
</section>


    <!-- Footer Section -->
    <footer>
        <div class="footerContainer">
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