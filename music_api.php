<?php
header('Content-Type: application/json');
include 'db.php';

// ✅ Fetch all songs with artist and album details
$sql = "SELECT 
            song.id,
            song.song_name,
            song.file_url,
            song.image_url,
            song.language,
            song.description,
            song.duration,
            song.upload_date,
            artists.artist_name,
            albums.album_name 
        FROM song
        LEFT JOIN artists ON song.artist_id = artists.id
        LEFT JOIN albums ON song.album_id = albums.id";

$result = $conn->query($sql);

$songs = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
}

// ✅ Output as JSON
echo json_encode($songs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
  