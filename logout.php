<?php
session_start();

// ลบ Session ทั้งหมด
session_unset();
session_destroy();

// ลบ Cookie Remember Me ถ้ามี
if (isset($_COOKIE['auth_token'])) {
    setcookie('auth_token', '', time() - 3600, "/"); // ลบ Cookie
}

// กลับไปหน้า Login
header("Location: login.php");
exit;
?>
