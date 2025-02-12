<?php
require_once('db.php');
require_once('utils/auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/travel.css">
</head>
<body id="dashboard-body">
<?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, is_admin: is_admin($conn),  in_home: true) ?>

    <main>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <section id="dashboard-hero">
        <h1>Explore the World with マジカルミライ Travel</h1>
        <p>Your adventure begins here.</p>
    </section>

    <!-- Main Dashboard Content -->
    <div class="dashboard-content">
        <!-- Search Section -->
        <div class="search-container">
            <input type="text" placeholder="Search for your next destination...">
            <button class="btn">Search</button>
        </div>

        <!-- Travel Section -->
        <section class="travel-section">
            <h2>Explore Our Travel Options</h2>
            <div class="travel-cards">
                <div class="travel-card">
                    <i class="fas fa-plane" style="font-size: 50px"></i>
                    <h3>Flights</h3>
                    <p>Find the best flight deals to your favorite destinations with our comprehensive search options.</p>
                   <a href="flights.php"> <button class="btn">Let's Fly!</button> </a>
                </div>
                <div class="travel-card">
                    <i class="fas fa-hotel" style="font-size: 50px"></i>
                    <h3>Hotels</h3>
                    <p>Stay at the best hotels with top-notch amenities and services.</p>
                    <button class="btn">Let's Stay!</button>
                </div>
                <div class="travel-card" style="font-size: 50px">
                    <i class="fas fa-train"></i>
                    <h3>Trains</h3>
                    <p>Experience the scenic routes and comfortable journeys with our train travel options.</p>
                    <button class="btn">Let's Travel!</button>
                </div>
            </div>
        </section>
        <section class="destination-section">
            <h2>Popular Destinations</h2>
            <div class="destination-cards">
                <div class="destination-card" style="background: url('img/tokyo.png') no-repeat center center/cover;">
                    <h3>Tokyo, Japan</h3>
                    <p id="onlywhite">Experience the bustling city life and rich culture of Tokyo.</p>
                    <button class="btn">Explore</button>
                </div>
                <div class="destination-card" style="background: url('img/paris.png') no-repeat center center/cover;">
                    <h3>Paris, France</h3>
                    <p id="onlywhite">Discover the romantic city of Paris with its iconic landmarks and charming streets.</p>
                    <button class="btn">Explore</button>
                </div>
                <div class="destination-card" style="background: url('img/bali.png') no-repeat center center/cover;">
                    <h3>Bali, Indonesia</h3>
                    <p id="onlywhite">Relax and unwind in the tropical paradise of Bali with its beautiful beaches and serene landscapes.</p>
                    <button class="btn">Explore</button>
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
</body>
</html>