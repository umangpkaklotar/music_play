<?php
session_start();
include '../db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "❌ Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <style>
        body {
            background-color: #121212;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        .login-container {
            background-color: #1f1f1f;
            padding: 40px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease;
        }

        .login-container h2 {
            text-align: center;
            color: #1db954;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }

        .login-container input {
            width: 100%;
            padding: 10px 15px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            outline: none;
            background-color: #222;
            color: white;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #1db954;
            color: #121212;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .login-container button:hover {
            background-color: #18a64f;
            transform: scale(1.05);
        }

        .error {
            color: #ff4d4d;
            margin-top: 10px;
            text-align: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button name="login">Login</button>
            
        </form>
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    </div>

</body>
</html>
