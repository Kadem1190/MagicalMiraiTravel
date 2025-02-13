<?php
require_once('db.php');
require_once('utils/auth.php');

ensure_admin($conn);
$account_id = $_COOKIE[COOKIE_ACCOUNT_ID_KEY] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['delete_id'])) {
        $stmt = $conn->prepare("DELETE FROM transactions WHERE id = ?");
        $stmt->bind_param('i', $_POST['delete_id']);
        $stmt->execute();
    } elseif (!empty($_POST['update_id'])) {
        $stmt = $conn->prepare("UPDATE transactions SET passenger_name = ?, flight_code = ?, seat = ?, payment_method = ?, status = ?, departure_date = ? WHERE id = ?");
        $stmt->bind_param('ssssssi', $_POST['passenger_name'], $_POST['flight_code'], $_POST['seat'], $_POST['payment_method'], $_POST['status'], $_POST['departure_date'], $_POST['update_id']);
        $stmt->execute();
    }
    header('Location: admin-transactions.php');
}
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
<?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, is_admin: is_admin($conn), in_admin: true) ?>

    <main>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <div class="flights-section">
        <?php
        $result = $conn->query("SELECT * FROM transactions");

        echo '<div class="dashboard-content">';
        echo '<h2>Manage Transactions</h2>';
        echo '<div style="display: flex; flex-direction: column; align-items: center; gap: 2rem;">';
        while ($row = $result->fetch_assoc()) {
            echo "<form action='' method='POST' class='dashboard-card'>
                <p><strong>ID:</strong> {$row['id']}</p>
                <p><strong>Passenger Name:</strong> <input type='text' name='passenger_name' value='{$row['passenger_name']}' /></p>
                <p><strong>Flight Code:</strong> <input type='text' name='flight_code' value='{$row['flight_code']}' /></p>
                <p><strong>Seat:</strong> <input type='text' name='seat' value='{$row['seat']}' /></p>
                <p><strong>Payment Method:</strong> <input type='text' name='payment_method' value='{$row['payment_method']}' /></p>
                <p><strong>Status:</strong> 
                    <select name='status'>
                        <option value='Dibayar'".($row['status'] === 'Dibayar' ? ' selected' : '').">Dibayar</option>
                        <option value='Diproses'".($row['status'] === 'Diproses' ? ' selected' : '').">Diproses</option>
                        <option value='Digagalkan'".($row['status'] === 'Digagalkan' ? ' selected' : '').">Digagalkan</option>
                    </select>
                </p>
                <p><strong>Departure Date:</strong> <input type='date' name='departure_date' value='{$row['departure_date']}' /></p>
                <button class='btn' type='submit' name='update_id' value='{$row['id']}'>Update</button>
                <button class='btn btn-outline' type='submit' name='delete_id' value='{$row['id']}'>Delete</button>
            </form>";
        }
        echo '</div>';
        echo '</div>';
        ?>
    </div>
    </main>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('input[type="date"]', {
            dateFormat: "Y-m-d"
        })
    </script>
    
    <!-- Footer -->
    <footer>
        <p>&copy; 2025 マジカルミライ Travel. All rights reserved.</p>
    </footer>
</body>
</html>
</body>
</html>