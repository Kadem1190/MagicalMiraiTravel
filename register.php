<?php
require_once('db.php');
require_once('utils/auth.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result_code = register($conn, $username, $email, $password);
    if ($result_code == 0) {
        // Put your code here if the register is failed because something
    } else if ($result_code == 1) {
        header('Location: travel.php');
    } else if ($result_code == 2) {
        // Put your code here if the register already have an account
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マジカルミライ Travel - Register</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body id="login-body">
<?php include('components/navbar.php'); echo get_navbar_html(logged_in: $logged_in, in_home: true) ?>

    <div class="container">
        <div class="login-box">
            <h1>こんにちは!</h1>
            <form action="register.php" method="POST">
                <div class="input-group">
                    <label for="username"><i class="fas fa-user"></i> ユーザーネーム </label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="email"><i class="fas fa-envelope"></i> Eメール</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i> パスワード </label>
                    <input type="password" id="password" name="password" required>
                </div>
                <!-- // blom jadi -->
                <button type="submit" class="btn">Register</button>
                <p id="register"> Already have an account? <a href="login.php">Login now!</a></p>
            </form>
        </div>
    </div>
</body>
</html>
