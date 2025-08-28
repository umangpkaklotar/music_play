<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['song_id'])) {
    http_response_code(400);
    echo "Invalid request";
    exit();
}

$user_id = $_SESSION['user_id'];
$song_id = intval($_GET['song_id']);

// Remove from playlist_songs
$stmt = $conn->prepare("DELETE FROM playlist_songs WHERE user_id = ? AND song_id = ?");
$stmt->bind_param("ii", $user_id, $song_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "success";
} else {
    http_response_code(500);
    echo "Failed to remove";
}
?>
