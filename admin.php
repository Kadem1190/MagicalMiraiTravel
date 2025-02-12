<?php
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
    <script src="js/script.js" defer></script>
</head>
<body id="dashboard-body">
    <!-- Navbar  -->
    <?php include('components/navbar.php'); echo get_navbar_html(in_home: true) ?>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <section id="dashboard-hero">
        <h1>Welcome Administrator :)</h1>
        <!-- <p>Hello, $USER</p> -- Implement fetching the username logged in -->
  </section>

    <!-- Main Dashboard Content -->
    <div class="dashboard-content">
        <!-- Dashboard Cards Grid -->
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <i class="fas fa-ticket-alt fa-3x"></i>
                <h2>Manage Accounts</h2>
                <p>Manage Accounts.</p>
                <a href="admin-accounts.php"><button class="btn">Book Now</button></a>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-ticket-alt fa-3x"></i>
                <h2>Manage Flights</h2>
                <p>Manage Flights.</p>
                <a href="admin-flights.php"><button class="btn">Book Now</button></a>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-ticket-alt fa-3x"></i>
                <h2>Manage Transactions</h2>
                <p>Manage Transactions.</p>
                <a href="admin-transactions.php"><button class="btn">Book Now</button></a>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <p>&copy; 2025 マジカルミライ Travel. All rights reserved.</p>
    </footer>
</body>
</html>