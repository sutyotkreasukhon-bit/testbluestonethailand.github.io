<?php include 'db.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];

    if ($password !== $confirm_password) {
        echo "<script>alert('รหัสผ่านและยืนยันรหัสไม่ตรงกัน!');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('สมัครสมาชิกสำเร็จ!'); window.location='login.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-container">
    <img src="images/logo2.png" class="logo">
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit">Register</button>
    </form>
    <a href="login.php" class="login-link">Back to Login</a>
    <hr>
    <p>Contact Us</p>
    <div class="social-icons">
        <a href="https://www.facebook.com/Bluestone.co.th/" target="_blank">
            <img src="images/icons-facebook.png" alt="Facebook">
        </a>
        <a href="https://www.instagram.com/bluestonethailand/" target="_blank">
            <img src="images/icons-ig.png" alt="Instagram">
        </a>
        <a href="https://line.me/ti/p/~@bluestonethailand" target="_blank">
            <img src="images/icons-line.png" alt="Line">
        </a>
        <a href="https://www.youtube.com/channel/UCQ3mRpetmm5Ek-LLdTjwaNQ" target="_blank">
            <img src="images/icons-youtube.png" alt="YouTube">
        </a>
    </div>
    <a href="https://www.bluestone.co.th" class="website-link">www.bluestone.co.th</a>
</div>
</body>
</html>
