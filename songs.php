<?php 
session_start();
include 'db.php';
// if(!isset($_SESSION['user_id'])){
//     header("Location: login.php");
//     exit();
// }

$sql = "SELECT song.*, artists.artist_name, albums.album_name 
        FROM song 
        LEFT JOIN artists ON song.artist_id = artists.id 
        LEFT JOIN albums ON song.album_id = albums.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Music Library</title>
</head>
<body>
    <h2>Music Library</h2>
    <a href="logout.php">Logout</a> | <a href="upload.php">Upload New Song</a><br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>Song</th>
            <th>Artist</th>
            <th>Album</th>
            <th>Action</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['song_name']; ?></td>
            <td><?php echo $row['artist_name']; ?></td>
            <td><?php echo $row['album_name']; ?></td>
            <td>
                <audio controls style="width: 200px;">
                    <source src="<?php echo $row['file_url']; ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
