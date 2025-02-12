<?php
require_once('utils/auth.php');
$status = logout();
if ($status) {
    header('Location: index.php');
} else {
    // Put your code here if the logout is failed
}
?>