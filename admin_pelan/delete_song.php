<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';
$id = $_GET['id'];

$conn->query("DELETE FROM song WHERE id = $id");

header("Location: song_list.php");
exit();
?>
