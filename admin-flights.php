<?php
require_once('db.php');
require_once('utils/auth.php');

ensure_admin($conn);
$account_id = $_COOKIE[COOKIE_ACCOUNT_ID_KEY] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['delete_id'])) {
        $stmt = $conn->prepare("DELETE FROM flights WHERE id = ?");
        $stmt->bind_param('i', $_POST['delete_id']);
        $stmt->execute();
    } else if (!empty($_POST['update_id'])) {
        $stmt = $conn->prepare("UPDATE flights SET code = ?, image = ?, name = ?, description = ? WHERE id = ?");
        $stmt->bind_param('ssssi',
            $_POST['code'],
            file_get_contents($_FILES['image-update-' . $_POST['update_id']]['tmp_name']),
            $_POST['name'],
            $_POST['description'],
            $_POST['update_id']
        );
        $stmt->execute();
    } else if (!empty($_POST['create'])) {
        $stmt = $conn->prepare("INSERT INTO flights (code, image, name, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss',
            $_POST['code'],
            file_get_contents($_FILES['image-create']['tmp_name']),
            $_POST['name'],
            $_POST['description']
        );
        $stmt->execute();
    }
    header('Location: admin-flights.php');
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
<?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, is_admin: is_admin($conn),  in_home: true) ?>

    <main>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <div class="flights-section">
        <?php
        $result = $conn->query("SELECT * FROM flights");

        echo '<div class="dashboard-content">';
        echo '<h2>Manage Flights</h2>';

        echo '<form method="POST" enctype="multipart/form-data" class="dashboard-card" style="margin-bottom: 2rem;">';
        echo '<h3>Create New Flight</h3>';
        echo '<p><strong>Code:</strong> <input type="text" name="code" required /></p>';
        echo '<p><strong>Image:</strong> <input type="file" accept="image/jpeg" name="image-create"/></p>';
        echo '<p><strong>Name:</strong> <input type="text" name="name" required /></p>';
        echo '<p><strong>Description:</strong> <textarea name="description" required></textarea></p>';
        echo '<button class="btn" type="submit" name="create" value="1">Create</button>';
        echo '</form>';

        echo '<div style="display: flex; flex-direction: column; align-items: center; gap: 2rem;">';
        while ($row = $result->fetch_assoc()) {
            echo "<form method='POST' enctype='multipart/form-data' class='dashboard-card'>
                <p><strong>ID:</strong> {$row['id']}</p>
                <p><strong>Code:</strong> <input type='text' name='code' value='{$row['code']}' /></p>
                <p><strong>Image:</strong> <input type='file' accept='image/jpeg' name='image-update-{$row['id']}' value='data:image/jpeg;base64,".base64_encode($row['image'])."'/></p>
                <p><strong>Name:</strong> <input type='text' name='name' value='{$row['name']}' /></p>
                <p><strong>Description:</strong> <textarea name='description'>{$row['description']}</textarea></p>
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
    
    <!-- Footer -->
    <footer>
        <p>&copy; 2025 マジカルミライ Travel. All rights reserved.</p>
    </footer>
</body>
</html>
</body>
</html>