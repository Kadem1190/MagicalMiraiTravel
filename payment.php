<?php
require_once('db.php');
require_once('utils/auth.php');

ensure_logged_in();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $_SESSION['booking_details'] = $_POST;
}

$details = $_SESSION['booking_details'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/flights.css">
</head>
<body id="dashboard-body">
<?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, is_admin: is_admin($conn), in_travel: true) ?>

    <main>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <form action="receipt.php" method="POST" class="flights-section">
        <h2>Payment Confirmation</h2>
        <div class="summary">
            <p><strong>Passenger Name:</strong> <?php echo htmlspecialchars($details['name'] ?? ''); ?></p>
            <p><strong>Flight:</strong> <?php echo htmlspecialchars($details['flight'] ?? ''); ?></p>
            <p><strong>Departure Time:</strong> <?php echo htmlspecialchars($details['date'] ?? ''); ?></p>
            <p><strong>Seat:</strong> <?php echo htmlspecialchars($details['seat'] ?? ''); ?></p>
            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($details['payment'] ?? ''); ?></p>
        </div>
        <div>
            <button type="submit" class="btn">Pay Now</button>
        </div>
    </form>
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

<style>
    .summary p {
        color: white;
        text-align: left;
        margin-bottom: 20px
    }
</style>