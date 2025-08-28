<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Delete profile image file from uploads if exists
$result = $conn->query("SELECT profile_img FROM user WHERE id = $user_id");
$user = $result->fetch_assoc();
if ($user && !empty($user['profile_img'])) {
    $file = 'uploads/' . $user['profile_img'];
    if (file_exists($file)) {
        unlink($file);
    }
}

// Delete user from database
$conn->query("DELETE FROM user WHERE id = $user_id");

// Destroy session
session_destroy();

// Redirect
header("Location: login.php");
exit();
?>
    