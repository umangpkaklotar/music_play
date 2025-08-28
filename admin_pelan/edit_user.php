<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';

if (!isset($_GET['id'])) {
    header('Location: user_list.php');
    exit();
}

$id = $_GET['id'];

$user = $conn->query("SELECT * FROM user WHERE id = $id")->fetch_assoc();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $conn->query("UPDATE user SET username = '$username', email = '$email' WHERE id = $id");

    header('Location: user_list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit User</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #121212;
            color: #fff;
            padding: 50px;
        }

        h2 {
            text-align: center;
            color: #1db954;
            margin-bottom: 30px;
            animation: fadeInDown 1s ease;
        }

        form {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            background-color: #1f1f1f;
            border-radius: 10px;
            animation: fadeIn 1.5s ease;
        }

        input {
            width: 100%;
            padding: 10px 15px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            outline: none;
            background-color: #222;
            color: white;
        }

        button {
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

        button:hover {
            background-color: #18a64f;
            transform: scale(1.05);
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #1db954;
            text-decoration: none;
            animation: fadeIn 2s ease;
        }

        a:hover {
            color: #1db954;
            text-decoration: underline;
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

    <h2>Edit User</h2>

    <form method="POST">
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <button type="submit" name="submit">Update User</button>
    </form>

    <a href="user_list.php">⬅ Back to User List</a>

</body>

</html>
