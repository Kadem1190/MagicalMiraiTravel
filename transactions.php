<?php
require_once('db.php');
require_once('utils/auth.php');

ensure_logged_in();
$account_id = $_COOKIE[COOKIE_ACCOUNT_ID_KEY] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="css/flights.css">
</head>
<body id="dashboard-body">
<?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, is_admin: is_admin($conn), in_travel: true) ?>

    <main>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <div class="flights-section">
        <?php
        if ($account_id) {
            $stmt = $conn->prepare("SELECT * FROM transactions WHERE accounts_id = ?");
            $stmt->bind_param('i', $account_id);
            $stmt->execute();
            $transactions = $stmt->get_result();
        
            echo '<div class="dashboard-content">';
            echo '<h2>Your Transaction History</h2>';
            while ($row = $transactions->fetch_assoc()) {
                echo "<div class='dashboard-card'>
                    <p><strong>Transaction ID:</strong> {$row['id']}</p>
                    <p><strong>Passenger Name:</strong> {$row['passenger_name']}</p>
                    <p><strong>Flight Code:</strong> {$row['flight_code']}</p>
                    <p><strong>Seat:</strong> {$row['seat']}</p>
                    <p><strong>Payment Method:</strong> {$row['payment_method']}</p>
                    <p><strong>Status:</strong> {$row['status']}</p>
                    <p><strong>Departure Date:</strong> {$row['departure_date']}</p>
                    <p><strong>Date:</strong> {$row['date']}</p>
                </div>";
            }
            echo '</div>';
        } else {
            echo '<div class="dashboard-content"><p>Please login to view your transaction history.</p></div>';
        }
        ?>
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
