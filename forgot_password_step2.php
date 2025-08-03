<?php 
include 'db.php'; 
session_start();

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password_step1.php");
    exit;
}

if (isset($_POST['reset_password'])) {
    $verify = $_POST['verify_code'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($verify != $_SESSION['reset_code']) {
        echo "<script>alert('Verify Code ไม่ถูกต้อง!');</script>";
    } elseif ($new != $confirm) {
        echo "<script>alert('รหัสผ่านใหม่และยืนยันไม่ตรงกัน!');</script>";
    } else {
        $hash = password_hash($new, PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];
        $conn->query("UPDATE users SET password='$hash' WHERE email='$email'");
        session_destroy();
        echo "<script>alert('เปลี่ยนรหัสผ่านสำเร็จ!'); window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <img src="logo.png" class="logo">
    <h2>Reset Password</h2>
    <form method="POST">
        <input type="text" name="verify_code" placeholder="Verify Code" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit" name="reset_password">Submit</button>
    </form>
</div>
</body>
</html>
