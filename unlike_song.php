<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    echo "error";
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$song_id = (int)$_POST['song_id'];

$sql = "DELETE FROM liked_songs WHERE user_id = $user_id AND song_id = $song_id";
if($conn->query($sql) && $conn->affected_rows > 0){
    echo "success";
}else{
    echo "error";
}
