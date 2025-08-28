<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';

$id = $_GET['id'];

// Delete related songs first
$conn->query("DELETE FROM playlist_song WHERE playlist_id = $id");

// Delete playlist
$conn->query("DELETE FROM playlist WHERE id = $id");

header("Location: playlist_list.php");
exit();
?>
