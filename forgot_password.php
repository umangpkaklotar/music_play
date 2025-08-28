<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $sql = $conn->query("SELECT * FROM user WHERE email='$email'");
    if ($sql->num_rows > 0) {
        $token = md5(uniqid(rand(), true));
        $conn->query("UPDATE user SET reset_token='$token' WHERE email='$email'");
        $link = "http://yourdomain.com/reset_password.php?token=" . $token;
        echo "<p>Reset Link: <a href='$link'>$link</a></p>";
    } else {
        echo "<p>Email not found.</p>";
    }
}
?>
<form method="POST">
    <h2>Forgot Password?</h2>
    <input type="email" name="email" placeholder="Enter Your Email" required><br><br>
    <button type="submit">Send Reset Link</button>
</form>
<a href="login.php">⬅ Back to Login</a>
