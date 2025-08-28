<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM user WHERE id = $user_id");
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Your Profile</title>
    <link rel="stylesheet" href="./css/profile.css">
</head>

<body>
    <div class="profile-card">
        <img src="uploads/<?php echo $user['profile_img']; ?>" alt="Profile">
        <h2><?php echo htmlspecialchars($user['username']); ?></h2>
        <p><?php echo htmlspecialchars($user['email']); ?></p>

        <a href="edit_profile.php">Edit Profile</a>

        <form method="POST" action="delete_profile.php" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <button type="submit">Delete Account</button>
        </form>

        <a href="user_song_list.php" class="back-btn">⬅ Back to Home</a>
    </div>
</body>

</html>