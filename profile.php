<?php
require_once('db.php');
require_once('utils/auth.php');

ensure_logged_in();
$account_id = $_COOKIE[COOKIE_ACCOUNT_ID_KEY] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['update_id'])) {
        if (empty($_POST['password'])) {
            $stmt = $conn->prepare("UPDATE accounts SET name = ?, email = ? WHERE id = ?");
            $stmt->bind_param('ssi',
                $_POST['name'],
                $_POST['email'],
                $_POST['update_id'],
            );
        } else {
            $password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE accounts SET name = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param('sssi',
                $_POST['name'],
                $_POST['email'],
                $password_hashed,
                $_POST['update_id'],
            );
        }
        $stmt->execute();
    }
    header('Location: profile.php');
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
        $stmt = $conn->prepare("SELECT * FROM accounts WHERE id = ?");
        $stmt->bind_param('i', $account_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            $success = logout();
            if ($success) {
                header('Location: login.php');
            }
            die();
        }

        echo '<div class="dashboard-content">';
        echo '<h2>Your Profile :D</h2>';

        echo '<form method="POST" class="dashboard-card" style="margin-bottom: 2rem;">';
        echo "
        <p><strong>ID:</strong> {$row['id']}</p>
        <p><strong>Name:</strong> <input type='text' name='name' value='{$row['name']}' /></p>
        <p><strong>Email:</strong> <input type='email' name='email' value='{$row['email']}' /></p>
        <p><strong>Password:</strong> <input type='password' name='password' /></p>
        <button class='btn' type='submit' name='update_id' value='{$row['id']}'>Update</button>
        ";
        echo '</form>';
        echo '</div>';
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