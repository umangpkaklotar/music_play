<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';

$id = $_GET['id'];
$song = $conn->query("SELECT * FROM song WHERE id = $id")->fetch_assoc();

if (isset($_POST['update'])) {
    $song_name = $_POST['song_name'];
    $sql = "UPDATE song SET song_name='$song_name' WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: song_list.php");
        exit();
    } else {
        echo "Error updating song.";
    }
}
?>

<h2>Edit Song</h2>
<form method="POST">
    <input type="text" name="song_name" value="<?php echo $song['song_name']; ?>" required><br><br>
    <button type="submit" name="update">Update Song</button>
</form>
<a href="song_list.php">⬅ Back to Song List</a>
