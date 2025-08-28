<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$song_id = $_GET['song_id'];

$sql = "SELECT * FROM liked_songs WHERE user_id = $user_id AND song_id = $song_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $conn->query("INSERT INTO liked_songs (user_id, song_id) VALUES ($user_id, $song_id)");
}

header("Location: user_song_list.php");
?>
