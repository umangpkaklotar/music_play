<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $song_name = $_POST['song_name'];
    $artist_id = $_POST['artist_id'];
    $album_id = $_POST['album_id'];
    $language = $_POST['language'];
    $description = $_POST['description'];

    // Media File Upload (Audio or Video)
    $media_file_name = $_FILES['media_file']['name'];
    $media_temp_name = $_FILES['media_file']['tmp_name'];
    $media_destination = "uploads/" . $media_file_name;
    move_uploaded_file($media_temp_name, $media_destination);

    // Image File Upload
    $image_file_name = $_FILES['image_file']['name'];
    $image_temp_name = $_FILES['image_file']['tmp_name'];
    $image_destination = "uploads/" . $image_file_name;
    move_uploaded_file($image_temp_name, $image_destination);

    // Insert into DB
    $sql = "INSERT INTO song (song_name, artist_id, album_id, file_url, image_url, language, description) 
            VALUES ('$song_name', '$artist_id', '$album_id', '$media_destination', '$image_destination', '$language', '$description')";

    if ($conn->query($sql)) {
        echo "✅ Audio / Vi4deo & Image Uploaded Successfully!";
    } else {
        echo "❌ Database Error! " . $conn->error;
    }
}
?>
<html>

<head>
    <link rel="stylesheet" href="./css/upload.css">
</head>

<body>


    <form method="POST" enctype="multipart/form-data">
        <h2>Upload New Song (Audio / Video) with Image</h2>
        <input type="text" name="song_name" placeholder="Song Name" required><br><br>

        <input type="number" name="artist_id" placeholder="Artist ID (manual)" required><br><br>
        <input type="number" name="album_id" placeholder="Album ID (manual)" required><br><br>

        <input type="text" name="language" placeholder="Language (Hindi, English etc)" required><br><br>

        <textarea name="description" placeholder="Song Description / Lyrics" rows="4" cols="50" required></textarea><br><br>

        <label>Audio / Video File:</label><br>
        <input type="file" name="media_file" accept="audio/*,video/*" required><br><br>

        <label>Image File (Playlist Image):</label><br>
        <input type="file" name="image_file" accept="image/*" required><br><br>

        <button type="submit" name="submit">Upload Media & Image</button>
    </form>
</body>

</html>