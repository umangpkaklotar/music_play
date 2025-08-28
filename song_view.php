<?php
include 'db.php';
$id = $_GET['id'];
$sql = "SELECT * FROM song WHERE id = $id";
$result = $conn->query($sql);
$song = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $song['song_name']; ?> - Details</title>
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px;
            text-align: center;
        }
        img {
            max-width: 400px;
            border-radius: 20px;
            margin-bottom: 20px;
        }
        h1 {
            color: #1db954;
        }
        p {
            color: #aaa;
            max-width: 600px;
        }
        video, audio {
            width: 100%;
            max-width: 600px;
            margin-top: 20px;
            border-radius: 10px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #1db954;
            text-decoration: none;
            padding: 10px 20px;
            border: 1px solid #1db954;
            border-radius: 30px;
        }
        a:hover {
            background-color: #1db954;
            color: #121212;
        }
    </style>
</head>
<body>

    <h1><?php echo htmlspecialchars($song['song_name']); ?></h1>
    <img src="<?php echo htmlspecialchars($song['image_url']); ?>" alt="Song Image">
    <p><?php echo htmlspecialchars($song['description']); ?></p>
    <p><strong>Language:</strong> <?php echo htmlspecialchars($song['language']); ?></p>

    <video controls>
        <source src="<?php echo htmlspecialchars($song['file_url']); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <a href="user_song_list.php">⬅ Back</a>

</body>
</html>
