<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

$totalSongs = $conn->query("SELECT COUNT(*) as total FROM song")->fetch_assoc()['total'];
$totalUsers = $conn->query("SELECT COUNT(*) as total FROM user")->fetch_assoc()['total'];
$totalPlaylists = $conn->query("SELECT COUNT(*) as total FROM playlist_songs")->fetch_assoc()['total'];
?>
<html>

<head>
    <style>
   
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #121212;
        color: #fff;
        padding: 40px;
        margin: 0;
    }

    h2 {
        color: #1db954;
        font-size: 2rem;
        margin-bottom: 10px;
        animation: fadeIn 1s ease;
    }

    h3 {
        color: #ffffff;
        font-weight: 500;
        margin-bottom: 20px;
        animation: fadeIn 1.2s ease;
    }

    ul {
        list-style: none;
        padding: 0;
        margin-bottom: 30px;
        animation: fadeInUp 1.5s ease;
    }

    ul li {
        background-color: #1f1f1f;
        padding: 15px 20px;
        margin-bottom: 10px;
        border-radius: 10px;
        color: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        transition: 0.3s;
    }

    ul li:hover {
        background-color: #1db954;
        color: #121212;
        transform: translateX(5px);
    }

    a {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px 5px;
        text-decoration: none;
        color: #1db954;
        border: 1px solid #1db954;
        border-radius: 30px;
        transition: 0.3s;
        font-weight: 500;
        animation: fadeIn 2s ease;
    }

    a:hover {
        background-color: #1db954;
        color: #121212;
        transform: scale(1.05);
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

</head>

<body>


    <h2>Welcome, <?php echo $_SESSION['admin']; ?></h2>
    <h3>Dashboard Summary</h3>
    <ul>
        <li>Total Songs: <?php echo $totalSongs; ?></li>
        <li>Total Users: <?php echo $totalUsers; ?></li>
        <li>Total Playlists: <?php echo $totalPlaylists; ?></li>
    </ul>

    <a href="../upload.php">Upload New Song</a> |
    <a href="song_list.php">Manage Songs</a> |
    <a href="add_artist.php">Add Artist</a> |
    <a href="add_album.php">Add Album</a> |
    <a href="user_list.php">User List</a> |
    <a href="logout.php">Logout</a>
</body>

</html>