<?php
require_once('db.php');
require_once('utils/auth.php');

ensure_admin($conn);
$account_id = $_COOKIE[COOKIE_ACCOUNT_ID_KEY] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['delete_id'])) {
        $stmt = $conn->prepare("DELETE FROM accounts WHERE id = ?");
        $stmt->bind_param('i', $_POST['delete_id']);
        $stmt->execute();
    } elseif (!empty($_POST['update_id'])) {
        $stmt = $conn->prepare("UPDATE accounts SET name = ?, email = ?, role = ? WHERE id = ?");
        $stmt->bind_param('sssi', $_POST['name'], $_POST['email'], $_POST['role'], $_POST['update_id']);
        $stmt->execute();
    }
    header('Location: admin-accounts.php');
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
<?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, in_home: true) ?>

    <main>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <div class="flights-section">
        <?php
        $result = $conn->query("SELECT * FROM accounts");

        echo '<div class="dashboard-content">';
        echo '<h2>Manage Accounts</h2>';
        echo '<form action="admin-accounts.php" method="POST" style="display: flex; flex-direction: column; align-items: center; gap: 2rem;">';
        while ($row = $result->fetch_assoc()) {
            if ($row['id'] == $account_id) continue;
            echo "<div class='dashboard-card'>
                    <p><strong>ID:</strong> {$row['id']}</p>
                    <p><strong>Name:</strong> <input type='text' name='name' value='{$row['name']}' /></p>
                    <p><strong>Email:</strong> <input type='email' name='email' value='{$row['email']}' /></p>
                    <p><strong>Role:</strong> 
                        <select name='role'>
                            <option value='user'".($row['role'] === 'user' ? ' selected' : '').">User</option>
                            <option value='admin'".($row['role'] === 'admin' ? ' selected' : '').">Admin</option>
                        </select>
                    </p>
                    <button class='btn' type='submit' name='update_id' value='{$row['id']}'>Update</button>
                    <button class='btn btn-outline' type='submit' name='delete_id' value='{$row['id']}'>Delete</button>
                  </div>";
        }
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