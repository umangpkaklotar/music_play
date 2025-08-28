<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';
$songs = $conn->query("SELECT * FROM song");
?>
<html>

<head>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #121212;
            color: #fff;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #1db954;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            animation: fadeIn 1.5s ease;
        }

        th, td {
            padding: 15px;
            border: 1px solid #333;
            text-align: center;
        }

        th {
            background-color: #1db954;
            color: #121212;
        }

        td {
            background-color: #1f1f1f;
        }

        a {
            color: #1db954;
            text-decoration: none;
            padding: 6px 12px;
            border: 1px solid #1db954;
            border-radius: 20px;
            transition: 0.3s;
            font-size: 14px;
        }

        a:hover {
            background-color: #1db954;
            color: #121212;
        }

        audio, video {
            width: 180px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #1db954;
            color: #121212;
            text-decoration: none;
            border-radius: 30px;
            transition: 0.3s;
            animation: fadeIn 2s ease;
        }

        .back-link:hover {
            background-color: #18a64f;
            transform: scale(1.05);
        }

        img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12%;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <h2>All Songs</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Song Name</th>
            <th>Language</th>
            <th>Description</th>
            <th>Image</th>
            <th>File</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $songs->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['song_name']; ?></td>
                <td><?php echo $row['language']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td>
                    <img src="../<?php echo $row['image_url']; ?>" alt="Image">
                </td>
                <td>
                    <?php if (strpos($row['file_url'], '.mp4') !== false || strpos($row['file_url'], '.webm') !== false): ?>
                        <video controls src="../<?php echo $row['file_url']; ?>"></video>
                    <?php else: ?>
                        <audio controls src="../<?php echo $row['file_url']; ?>"></audio>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit_song.php?id=<?php echo $row['id']; ?>">Edit</a>  <br><br>
                    <a href="delete_song.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a class="back-link" href="dashboard.php">⬅ Back to Dashboard</a>
</body>

</html>
