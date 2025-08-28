<?php
session_start();
include 'db.php';

// if (!isset($_SESSION['user_id'])) {
//     die("Not logged in.");
// }

$user_id = $_SESSION['user_id'];
$song_id = $_GET['song_id'] ?? null;

if ($song_id) {
    // Check if song already in playlist
    $check = $conn->prepare("SELECT * FROM playlist_songs WHERE user_id = ? AND song_id = ?");
    $check->bind_param("ii", $user_id, $song_id);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO playlist_songs (user_id, song_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $song_id);
        $stmt->execute();
    }
    header("Location: user_song_list.php"); // or back to referring page
    exit();
}
?>
