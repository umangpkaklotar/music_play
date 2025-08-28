<?php 
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit'])){
    $playlist_name = $_POST['playlist_name'];
    $user_id = $_SESSION['user_id'];

    $conn->query("INSERT INTO playlists (user_id, playlist_name) VALUES ('$user_id', '$playlist_name')");
    echo "Playlist Created Successfully!";
}
?>

<h2>Create New Playlist</h2>
<form method="POST">
    <input type="text" name="playlist_name" placeholder="Playlist Name" required><br><br>
    <button type="submit" name="submit">Create Playlist</button>
</form> 

<br><a href="songs.php">Back to Songs</a>
