<?php
require_once('utils/auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/flights.css">
</head>
<body id="dashboard-body">
<?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, in_home: true) ?>

    <main>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <section id="dashboard-hero">
        <h1>Find Your Perfect Flight with マジカルミライ Travel</h1>
        <p>Book your next adventure today.</p>
    </section>

    <!-- Main Dashboard Content -->
    <div class="dashboard-content">
        <!-- Search Section -->
        <div class="search-container">
            <input type="text" placeholder="Search for flights...">
            <button class="btn">Search</button>
        </div>

        <!-- Flights Section -->
        <section class="flights-section">
            <h2>Available Flights</h2>
            <div class="flights-cards">
                <div class="flights-card">
                    <img src="img/flight1.jpg" alt="Flight 1">
                    <h3>Tokyo to New York</h3>
                    <p>Experience the best in-flight services and comfort.</p>
                    <button class="btn">Book Now</button>
                </div>
                <div class="flights-card">
                    <img src="img/flight2.jpg" alt="Flight 2">
                    <h3>Paris to Tokyo</h3>
                    <p>Enjoy a seamless travel experience with our top-rated airlines.</p>
                    <button class="btn">Book Now</button>
                </div>
                <div class="flights-card">
                    <img src="img/flight3.jpg" alt="Flight 3">
                    <h3>London to Bali</h3>
                    <p>Fly in style and comfort with our premium flight options.</p>
                    <button class="btn">Book Now</button>
                </div>
            </div>
        </section>
    </div>
    </main>
    <script src="js/script.js"></script>
    
    <!-- Footer -->
    <footer>
        <p>&copy; 2025 マジカルミライ Travel. All rights reserved.</p>
    </footer>
</body>
</html>