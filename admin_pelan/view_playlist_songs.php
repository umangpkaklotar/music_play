<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

$playlist_id = $_GET['id'];

$sql = "SELECT song.* FROM playlist_songs 
        JOIN song ON playlist_songs.song_id = song.id 
        WHERE playlist_songs.playlist_id = '$playlist_id'";
$result = $conn->query($sql);
?>

<h2>Songs in Playlist</h2>

<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <h4><?php echo $row['song_name']; ?></h4>
        <audio controls>
            <source src="../<?php echo $row['file_url']; ?>" type="audio/mpeg">
        </audio>
        <hr>
    <?php endwhile; ?>
<?php else: ?>
    <p>No songs in this playlist.</p>
<?php endif; ?>

<a href="playlist_list.php">⬅ Back to Playlist List</a>
