<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $profile_img = $_FILES['profile_img']['name'];
    $target = "uploads/" . basename($profile_img);
    
    if (!empty($profile_img)) {
        move_uploaded_file($_FILES['profile_img']['tmp_name'], $target);
        $conn->query("UPDATE user SET username='$username', email='$email', profile_img='$profile_img' WHERE id=$user_id");
    } else {
        $conn->query("UPDATE user SET username='$username', email='$email' WHERE id=$user_id");
    }

    header("Location: profile.php");
    exit();
}

$result = $conn->query("SELECT * FROM user WHERE id = $user_id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .edit-card {
            background-color: #1f1f1f;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }
        input {
            display: block;
            margin: 10px auto;
            padding: 10px;
            width: 90%;
            border-radius: 5px;
            border: none;
        }
        button {
            padding: 10px 20px;
            background-color: #1db954;
            color: #121212;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #18a64f;
        }
    </style>
</head>
<body>
    <form class="edit-card" method="POST" enctype="multipart/form-data">
        <h2>Edit Profile</h2>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <input type="file" name="profile_img">
        <button type="submit">Update</button>
    </form>
</body>
</html>
