<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';
$id = $_GET['id'];

// Delete user
$conn->query("DELETE FROM user WHERE id = $id");

header("Location: user_list.php");
exit();
?>
