<?php
require_once('db.php');
require_once('utils/auth.php');

ensure_logged_in();

session_start();
$details = $_SESSION['booking_details'] ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $account_id = $_COOKIE[COOKIE_ACCOUNT_ID_KEY];
    $stmt = $conn->prepare("INSERT INTO transactions (accounts_id, passenger_name, flight_code, seat, departure_date, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('isssss', $account_id, $details['name'], $details['flight'], $details['seat'], $details['date'], $details['payment']);
    $stmt->execute();
    
    if ($error = mysqli_error($conn)) {
        die($error);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/flights.css">
    <link rel="stylesheet" href="css/print.css" media="print">

</head>
<body id="dashboard-body">
<?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, is_admin: is_admin($conn), in_travel: true) ?>

    <main>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <div class="flights-section">   
        <h2>Order Reciept</h2>
        <div class="receipt">
            <p><strong>Passenger Name:</strong> <?php echo htmlspecialchars($details['name'] ?? ''); ?></p>
            <p><strong>Flight:</strong> <?php echo htmlspecialchars($details['flight'] ?? ''); ?></p>
            <p><strong>Departure Time:</strong> <?php echo htmlspecialchars($details['date'] ?? ''); ?></p>
            <p><strong>Seat:</strong> <?php echo htmlspecialchars($details['seat'] ?? ''); ?></p>
            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($details['payment'] ?? ''); ?></p>
            <p><strong>Status:</strong> Paid</p>
        </div>
        <a class="btn" onclick="setTimeout(() => window.print(), 100)">Print Receipt</a>        <a href="flights.php" class="btn">Back to Home Page</a>
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
<style>
    a.btn {
        text-decoration: none
    }
    .receipt {
        margin-bottom: 50px;
    }
    .dark-mode .receipt p {
        color: var(--text-dark);
    }
</style>