<?php
require_once('db.php');
require_once('utils/auth.php');

ensure_logged_in();

if (!empty($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $stmt = $conn->prepare("SELECT id, code, image, name, description FROM flights WHERE name LIKE ?");
    $stmt->bind_param('s', $search);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $stmt = $conn->prepare("SELECT id, code, image, name, description FROM flights");
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/flights.css">
</head>
<body id="dashboard-body">
<?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, is_admin: is_admin($conn), in_travel: true) ?>

    <main>
    <div id="empty-space"></div>
    <!-- Hero Section -->
    <section id="dashboard-hero">
        <h1>Find Your Perfect Flight with マジカルミライ Travel</h1>
        <p>Book your next adventure today.</p>
    </section>

    <!-- Main Dashboard Content -->
    <div class="dashboard-content">
        <!-- Search Section -->
        <form action="" method="GET" class="search-container">
            <input type="text" placeholder="Search for flights..." name="search">
            <button class="btn">Search</button>
        </form>

        <!-- Flights Section -->
        <section class="flights-section">
            <h2>Available Flights</h2>
            <div class="flights-cards">
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="flights-card">
                        <img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" alt="Flight '.$row['id'].'">
                        <h3>'.$row['name'].'</h3>
                        <p>'.$row['description'].'</p>
                        <a href="tickets.php?flight='.$row['code'].'" role="button" class="btn">Book Now</a>
                    </div>
                    ';
                }
                ?>
                <!-- <div class="flights-card">
                    <img src="img/flight1.jpg" alt="Flight 1">
                    <h3>Tokyo to New York</h3>
                    <p>Experience the best in-flight services and comfort.</p>
                    <a href="tickets.php?flight=TKY-NYK" role="button" class="btn">Book Now</a>
                </div>
                <div class="flights-card">
                    <img src="img/flight2.jpg" alt="Flight 2">
                    <h3>Paris to Tokyo</h3>
                    <p>Enjoy a seamless travel experience with our top-rated airlines.</p>
                    <a href="tickets.php?flight=PRS-TKY" role="button" class="btn">Book Now</a>
                </div>
                <div class="flights-card">
                    <img src="img/flight3.jpg" alt="Flight 3">
                    <h3>London to Bali</h3>
                    <p>Fly in style and comfort with our premium flight options.</p>
                    <a href="tickets.php?flight=LDN-BLI" role="button" class="btn">Book Now</a>
                </div> -->
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