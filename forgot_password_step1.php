<?php 
include 'db.php'; 
session_start();

if (isset($_POST['send_token'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $code = rand(100000, 999999);
        $_SESSION['reset_code'] = $code;
        $_SESSION['reset_email'] = $email;
        echo "<script>alert('Verify Code: $code (ระบบจริงส่งไปอีเมล)'); window.location='forgot_password_step2.php';</script>";
    } else {
        echo "<script>alert('Email ไม่ถูกต้อง!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <img src="images/logo2.png" class="logo">
    <h2>Forgot Password</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="send_token">Send Reset Token</button>
    </form>
    <hr>
    <p>Contact Us</p>
    <a href="login.php" class="login-link">Back to Login</a>
</div>
</body>
</html>
