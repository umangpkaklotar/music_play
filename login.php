<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Login</title>
   <link rel="stylesheet" href="./css/user_login.css">
</head>

<body>
    <div class="login-container">
        <h2>User Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign up</a>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = $conn->query("SELECT * FROM user WHERE email='$email'");
            if ($sql->num_rows > 0) {
                $user = $sql->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['profile_img'] = $user['profile_img']; // store user profile image
                    header("Location: user_song_list.php");
                    exit();
                } else {
                    echo "<p class='error'>❌ Invalid Password</p>";
                }
            } else {
                echo "<p class='error'>❌ Email not found</p>";
            }
        }
        ?>
    </div>
</body>

</html>
