<?php
require_once('db.php');
require_once('utils/auth.php');

ensure_logged_in();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets Page</title>
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
        <h2>Pesan Tiket Pesawat Anda</h2>
        <form method="POST" action="payment.php" class="booking-form">
            <div class="input-group">
                <label for="name">Nama Penumpang</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="flight">Pilih Penerbangan</label>
                <select id="flight" name="flight" value="<?= !empty($_GET['flight']) ? $_GET['flight'] : '' ?>">
                    <option value="TKY-NYK">Tokyo to New York</option>
                    <option value="PRS-TKY">Paris to Tokyo</option>
                    <option value="LDN-BLI">London to Bali</option>
                </select>
            </div>
            <div class="input-group">
                <label for="date">Pilih Jadwal</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="seat">Pilih Tempat Duduk</label>
                <div class="seat-map">
                    <?php for ($row = 'A'; $row <= 'C'; $row++) { ?>
                        <div class="seat-row">
                            <?php for ($col = 1; $col <= 6; $col++) { ?>
                                <input type="radio" name="seat" id="<?php echo $row . $col; ?>" value="<?php echo $row . $col; ?>">
                                <label for="<?php echo $row . $col; ?>" class="seat"><?php echo $row . $col; ?></label>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="input-group">
                <label for="payment">Metode Pembayaran</label>
                <select id="payment" name="payment">
                    <option value="Kartu Kredit">Kartu Kredit</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="e-Wallet">e-Wallet</option>
                </select>
            </div>
            <button type="submit" class="btn">Pesan Tiket</button>
        </form>
    </div>
    </main>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('input[type="date"]', {
            dateFormat: "Y-m-d",
            minDate: "<?= date('Y-m-d') ?>",
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

<style>
/* Tambahkan styling untuk seat-map */
.seat-map {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 10px;
    justify-content: center;
    margin: 20px 0;
}
.seat-row {
    display: contents;
}
.seat {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border: 2px solid var(--primary-color);
    border-radius: 5px;
    cursor: pointer;
    background-color: #fff;
    transition: 0.3s;
}
.seat:hover {
    background-color: var(--secondary-color);
    color: #fff;
}
.seat input[type="radio"] {
    display: none;
}
.seat input[type="radio"]:checked + label {
    background-color: var(--primary-color);
    color: #fff;
}
</style>
