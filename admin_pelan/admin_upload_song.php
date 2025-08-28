<?php
session_start();
include '../db.php';

// ✅ Handle AJAX Upload
if(isset($_POST['ajax']) && $_POST['ajax'] == '1'){
    $song_name = trim($_POST['song_name']);
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $language = $_POST['language'];
    $description = $_POST['description'];

    // ✅ Create folder based on song name
    $folder_name = preg_replace('/[^A-Za-z0-9_-]/', '_', $song_name);
    $upload_dir = __DIR__ . "/uploads/" . $folder_name;
    if(!is_dir($upload_dir)){
        mkdir($upload_dir, 0777, true);
    }

    // ✅ Audio/Video Upload
    $media_file = $_FILES['media_file']['name'];
    $media_tmp = $_FILES['media_file']['tmp_name'];
    $media_path = "uploads/$folder_name/" . time() . "_" . basename($media_file);
    move_uploaded_file($media_tmp, __DIR__ . "/" . $media_path);

    // ✅ Image Upload
    $image_file = $_FILES['image_file']['name'];
    $image_tmp = $_FILES['image_file']['tmp_name'];
    $image_path = "uploads/$folder_name/" . time() . "_" . basename($image_file);
    move_uploaded_file($image_tmp, __DIR__ . "/" . $image_path);

    // ✅ Save to DB
    $sql = "INSERT INTO song (song_name, artist_id, album_id, file_url, image_url, language, description) 
            VALUES ('$song_name', '$artist', '$album', '$media_path', '$image_path', '$language', '$description')";
    if($conn->query($sql)){
        // ✅ Return JSON for instant preview
        echo json_encode([
            "status"=>"success",
            "song_name"=>$song_name,
            "file_url"=>$media_path,
            "image_url"=>$image_path,
            "language"=>$language,
            "description"=>$description
        ]);
    }else{
        echo json_encode(["status"=>"error","msg"=>$conn->error]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Song</title>
    <style>
        body{background:#000;color:#fff;font-family:sans-serif;text-align:center;padding:20px;}
        form{background:#111;padding:20px;border-radius:10px;display:inline-block;margin-top:20px;}
        input,textarea,button{width:90%;padding:10px;margin:8px 0;border:none;border-radius:5px;}
        input,textarea{background:#222;color:#fff;}
        button{background:#1db954;color:#fff;cursor:pointer;}
        h2{color:#1db954;}
        #preview{margin-top:20px;}
        .song-card{background:#111;padding:10px;border-radius:5px;display:flex;align-items:center;margin:10px auto;width:300px;}
        .song-card img{width:60px;height:60px;margin-right:10px;border-radius:5px;}
    </style>
</head>
<body>
    <h2>Upload New Song</h2>

    <form id="uploadForm" enctype="multipart/form-data">
        <input type="hidden" name="ajax" value="1">
        <input type="text" name="song_name" placeholder="Song Name" required><br>
        <input type="text" name="artist" placeholder="Artist ID" required><br>
        <input type="text" name="album" placeholder="Album ID" required><br>
        <input type="text" name="language" placeholder="Language" required><br>
        <textarea name="description" placeholder="Song Description" rows="3" required></textarea><br>

        <label>Audio / Video:</label>
        <input type="file" name="media_file" accept="audio/*,video/*" required><br>

        <label>Image File:</label>
        <input type="file" name="image_file" accept="image/*" required><br>

        <button type="submit">Upload Song</button>
    </form>

    <!-- ✅ Instant Preview Area -->
    <div id="preview"></div>

    <script>
    document.getElementById('uploadForm').addEventListener('submit', function(e){
        e.preventDefault();
        const formData = new FormData(this);

        fetch('admin_upload_song.php', {
            method: 'POST',
            body: formData
        })
        .then(res=>res.json())
        .then(data=>{
            if(data.status === "success"){
                const preview = document.getElementById('preview');
                preview.innerHTML = `
                    <div class="song-card">
                        <img src="${data.image_url}">
                        <div>
                            <h4>${data.song_name}</h4>
                            <p>${data.language}</p>
                            <small>${data.description}</small>
                        </div>
                    </div>
                `;
            }else{
                alert("Error: "+data.msg);
            }
        });
    });
    </script>
</body>
</html>
