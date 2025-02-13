<?php
require_once('db.php');
require_once('utils/auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マジカルミライ Travel - Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<?php
if (!$logged_in && !array_key_exists('search', $_GET)) {
    echo '
    <div id="preloader">
        <img src="img/mm24.gif" alt="Loading..." class="loading-animation" width="">
    </div>
    ';
}
?>
<body id="dashboard-body">
    <!-- Navbar  -->
    <?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, is_admin: is_admin($conn), in_home: true) ?>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <section id="dashboard-hero">
        <?php
        if ($logged_in) {
            $account_id = $_COOKIE[COOKIE_ACCOUNT_ID_KEY];
            $stmt = $conn->prepare("SELECT name FROM accounts WHERE id = ?");
            $stmt->bind_param('i', $account_id);
            $stmt->execute();

            $result = $stmt->get_result();
            $account_name = $result->fetch_assoc()['name'];

            echo '
            <p>Hello, '.$account_name.'</p>
            ';
        } else {
            echo '
            <h1>Explore the World with マジカルミライ Travel</h1>
            ';
        }
        ?>
  </section>

    <!-- Main Dashboard Content -->
    <div class="dashboard-content">
        <!-- Search Section -->
        <form action="" method="GET" class="search-container">
            <input type="text" placeholder="Search for your next destination..." name="search" value="<?= $_GET['search'] ?? '' ?>">
            <button class="btn">Search</button>
        </form>

        <!-- Dashboard Cards Grid -->
        <div class="dashboard-grid">
            <!-- Welcome Card -->
            <div class="dashboard-card">
                <i class="fas fa-user-circle fa-3x"></i>
                <h2>Welcome Back, Traveler!</h2>
                <p>Manage your preferences and saved trips.</p>
                <a href="profile.php"><button class="btn">View Profile</button></a>
            </div>

            <!-- Plan Journey Card -->
            <div class="dashboard-card" style="position: relative; overflow: hidden; padding: 20px; text-align: center;">
                <i class="fas fa-route fa-3x"></i>
                <h2>Plan Your Journey</h2>
                <p>Customize your itinerary with ease.</p>
                <button class="btn">[!]</button>
                
                <!-- Construction Line -->
                <span style="
                    position: absolute; 
                    top: 50%; 
                    left: 50%; 
                    transform: translate(-50%, -50%) rotate(-20deg); 
                    background: repeating-linear-gradient(
                        45deg, 
                        black, black 10px, 
                        yellow 10px, yellow 20px
                    ); 
                    color: white; 
                    text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
                    font-weight: bold; 
                    font-size: 1.2em; 
                    padding: 10px 30px; 
                    text-transform: uppercase; 
                    opacity: 0.8; 
                    white-space: nowrap;
                ">
                    UNDER CONSTRUCTION
                </span>
            </div>
            

            <!-- Booking Card -->
            <div class="dashboard-card">
                <i class="fas fa-ticket-alt fa-3x"></i>
                <h2>Book Your Travel</h2>
                <p>Find flights, hotels, and activities.</p>
                <a href="travel.php"><button class="btn">Book Now</button></a>
            </div>

            <!-- Budget Tools Card -->
            <div class="dashboard-card" style="position: relative; overflow: hidden; padding: 20px; text-align: center;">
                <i class="fas fa-calculator fa-3x"></i>
                <h2>View Transactions</h2>
                <p>Keep track of expenses</p>
               <a href="transactions.php"> <button class="btn">View Transactions</button></a>
            </div>

            <!-- Travel Inspiration Card -->
            <div class="dashboard-card" style="position: relative; overflow: hidden; padding: 20px; text-align: center;">
                <i class="fas fa-lightbulb fa-3x"></i>
                <h2>Get Inspired</h2>
                <p>Discover new destinations and stories.</p>
                <button class="btn">[!]</button>
                                <span style="
                                position: absolute; 
                                top: 50%; 
                                left: 50%; 
                                transform: translate(-50%, -50%) rotate(-20deg); 
                                background: repeating-linear-gradient(
                                    45deg, 
                                    black, black 10px, 
                                    yellow 10px, yellow 20px
                                ); 
                                color: white; 
                                text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
                                font-weight: bold; 
                                font-size: 1.2em; 
                                padding: 10px 30px; 
                                text-transform: uppercase; 
                                opacity: 0.8; 
                                white-space: nowrap;
                            ">
                                UNDER CONSTRUCTION
                            </span>
            </div>

            <!-- Weather Updates Card -->
            <div class="dashboard-card" style="position: relative; overflow: hidden; padding: 20px; text-align: center;">
                <i class="fas fa-cloud-sun fa-3x"></i>
                <h2>Weather Updates</h2>
                <p>Check weather forecasts for your destinations.</p>
                <button class="btn btn-outline">[!]</button>
                                <span style="
                                position: absolute; 
                                top: 50%; 
                                left: 50%; 
                                transform: translate(-50%, -50%) rotate(-20deg); 
                                background: repeating-linear-gradient(
                                    45deg, 
                                    black, black 10px, 
                                    yellow 10px, yellow 20px
                                ); 
                                color: white; 
                                text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
                                font-weight: bold; 
                                font-size: 1.2em; 
                                padding: 10px 30px; 
                                text-transform: uppercase; 
                                opacity: 0.8; 
                                white-space: nowrap;
                            ">
                                UNDER CONSTRUCTION
                            </span>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <p>&copy; 2025 マジカルミライ Travel. All rights reserved.</p>
    </footer>
</body>
</html>
<script src="js/script.js" defer></script>
<script src="js/index.js" defer></script>