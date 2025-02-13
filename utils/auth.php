<?php
define('COOKIE_ACCOUNT_ID_KEY', 'accounts_id');

$logged_in = isset($_COOKIE[COOKIE_ACCOUNT_ID_KEY]);

function set_logged_in($account_id) {
    setcookie(
        COOKIE_ACCOUNT_ID_KEY,
        $account_id,
        time() + 2628000 * 12
    ); // 2628000 = 1 month
}

function login($conn, string $name, string $password): array {
    $stmt = mysqli_prepare($conn, "SELECT id, role, password FROM accounts WHERE name = ?");
    mysqli_stmt_bind_param($stmt, 's', $name);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1 && password_verify($password, $row['password'])) {
        set_logged_in($row['id']);
        return ['role'=>$row['role'], 'success'=>true];
    } else {
        return ['role'=>'user', 'success'=>false];
    }
}

function register($conn, string $name, string $email, string $password): array {
    $stmt = mysqli_prepare($conn, "SELECT id FROM accounts WHERE name = ?");
    mysqli_stmt_bind_param($stmt, 's', $name);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        return ['role'=>'user', 'code'=>2];
    }
    
    $stmt = mysqli_prepare($conn, "INSERT INTO accounts (name, email, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sss', $name, $email, password_hash($password, PASSWORD_DEFAULT));
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    if (!mysqli_error($conn)) {
        $stmt = mysqli_prepare($conn, "SELECT id, role FROM accounts WHERE name = ?");
        mysqli_stmt_bind_param($stmt, 's', $name);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        
        set_logged_in($row['id']);
        return ['role'=>$row['role'], 'code'=>1];
    } else {
        return ['role'=>'user', 'code'=>0];
    }
}

function logout() {
    setcookie(COOKIE_ACCOUNT_ID_KEY, '', time() - 3600); // 3600 = 1 hour
    return true;
}

function ensure_logged_in() {
    if (empty($_COOKIE[COOKIE_ACCOUNT_ID_KEY])) {
        header('Location: login.php');
        die();
    }
}

function ensure_admin($conn) {
    global $logged_in;
    $account_id = $_COOKIE[COOKIE_ACCOUNT_ID_KEY];
    $stmt = mysqli_prepare($conn, "SELECT role FROM accounts WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $account_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $account = mysqli_fetch_assoc($result);
    
    if (!$logged_in || !$account || ($account['role'] ?? 'user') !== 'admin') {
        header('HTTP/1.1 403 Forbidden');
        die('Access denied');
    }
}

function is_admin($conn) {
    if (empty($_COOKIE[COOKIE_ACCOUNT_ID_KEY])) return false;

    $account_id = $_COOKIE[COOKIE_ACCOUNT_ID_KEY];
    $stmt = mysqli_prepare($conn, "SELECT role FROM accounts WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $account_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $account = mysqli_fetch_assoc($result);
    
    return $account && $account['role'] == 'admin';
}

function is_logged_in() {
    return !empty($_COOKIE[COOKIE_ACCOUNT_ID_KEY]);
}
?>