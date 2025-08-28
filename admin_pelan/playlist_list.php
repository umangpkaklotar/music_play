<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';

$playlists = $conn->query("SELECT playlists.*, user.username FROM playlists 
                            LEFT JOIN user ON playlists.user_id = user.id");
?>

<h2>All Playlists</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Playlist Name</th>
        <th>User</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $playlists->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['playlist_name']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td>
            <a href="view_playlist_songs.php?id=<?php echo $row['id']; ?>">View Songs</a> | 
            <a href="delete_playlist.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="dashboard.php">⬅ Back to Dashboard</a>
