<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Songs</title>
</head>
<body>
<h2>Add Song</h2>
<form id="addForm">
    <input name="song_name" placeholder="Song Name" required><br>
    <input name="file_url" placeholder="File URL" required><br>
    <input name="image_url" placeholder="Image URL" required><br>
    <input name="language" placeholder="Language"><br>
    <input name="description" placeholder="Description"><br>
    <button>Add Song</button>
</form>

<h2>Delete Song</h2>
<form id="delForm">
    <input name="id" placeholder="Song ID" required>
    <button>Delete</button>
</form>

<script>
// Add Song
document.getElementById("addForm").onsubmit = async e=>{
    e.preventDefault();
    const data = Object.fromEntries(new FormData(e.target).entries());
    await fetch("songs_api.php",{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify(data)});
    alert("Song Added");
};

// Delete Song
document.getElementById("delForm").onsubmit = async e=>{
    e.preventDefault();
    const data = new URLSearchParams(new FormData(e.target));
    await fetch("songs_api.php",{method:"DELETE",body:data});
    alert("Song Deleted");
};
</script>
</body>
</html>
