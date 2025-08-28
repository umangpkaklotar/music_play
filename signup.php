<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Signup</title>
  <link rel="stylesheet" href="./css/signup.css">
</head>

<body>
    <div class="signup-container">
        <h2>Create Account</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="file" name="profile_img" accept="image/*">
            <button type="submit">Signup</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Handle profile image
            $profile_img = 'default.jpg'; // fallback default image
            if (!empty($_FILES['profile_img']['name'])) {
                $profile_img = time() . '_' . $_FILES['profile_img']['name'];
                move_uploaded_file($_FILES['profile_img']['tmp_name'], 'uploads/' . $profile_img);
            }

            $conn->query("INSERT INTO user (username, email, password, profile_img) 
                          VALUES ('$username', '$email', '$password', '$profile_img')");
            echo "<p class='success'>✅ Signup Success! <a href='login.php'>Login Now</a></p>";
        }
        ?>
    </div>
</body>

</html>
