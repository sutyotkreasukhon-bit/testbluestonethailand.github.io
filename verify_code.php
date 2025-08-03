<?php include 'db.php'; session_start(); ?>
<?php
if (!isset($_SESSION['reset_email'])) header("Location: forget_password.php");

if (isset($_POST['verify'])) {
    if ($_POST['code'] == $_SESSION['reset_code']) {
        $_SESSION['verified'] = true;
    } else {
        echo "<script>alert('รหัสไม่ถูกต้อง');</script>";
    }
}

if (isset($_POST['reset'])) {
    if ($_SESSION['verified']) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];
        $conn->query("UPDATE users SET password='$new_password' WHERE email='$email'");
        session_destroy();
        echo "<script>alert('เปลี่ยนรหัสผ่านสำเร็จ'); window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verify Code</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Verify Code</h2>
    <?php if (!isset($_SESSION['verified'])): ?>
    <form method="POST">
        <input type="text" name="code" placeholder="Enter Verify Code" required><br>
        <button type="submit" name="verify">Verify</button>
    </form>
    <?php else: ?>
    <form method="POST">
        <input type="password" name="new_password" placeholder="New Password" required><br>
        <button type="submit" name="reset">Reset Password</button>
    </form>
    <?php endif; ?>
</body>
</html>
