<?php


session_start();
include 'db.php';
// include 'header.php';

// ✅ User logged in check
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = (int) $_SESSION['user_id'];

$sql = "SELECT song.* FROM liked_songs 
        JOIN song ON liked_songs.song_id = song.id 
        WHERE liked_songs.user_id = $user_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Your Liked Songs</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/liked_song.css">
    <style>
        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
    </style>
</head>

<body>

    <video autoplay loop muted playsinline id="bg-video">
        <source src="https://cdn.prod.website-files.com/5f045d2f34d91988db9ec750/5f0c2839838516b7a570a3c1_MH-BG_v7-transcode.mp4" type="video/mp4">
        <source src="https://cdn.prod.website-files.com/5f045d2f34d91988db9ec750/5f0c2839838516b7a570a3c1_MH-BG_v7-transcode.webm" type="video/webm">
    </video>
    <header class="top-header">
        <div class="left-header">
            <!-- <button class="toggle-btn" id="toggle-btn">☰</button> -->
            <div class="logo">
                <a href="user_song_list.php"><img src="image/my.png" alt=""></a>
            </div>
        </div>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search song / artist / album...">
        </div>
        <div class="right-header">
            <i class="ri-cast-line"></i>
            <div style="position: relative;">
                <img src="uploads/<?php echo isset($_SESSION['profile_img']) ? htmlspecialchars($_SESSION['profile_img']) : 'default.png'; ?>"
                    alt="Profile"
                    style="width: 40px; height: 40px; border-radius: 50%; cursor:pointer;"
                    onclick="toggleMenu()">
                <div id="profileMenu" style="display:none; position: absolute; right: 0; background: #222; padding: 10px; border-radius: 10px; width: 10vw;">
                    <p style="color:#1db954;    align-items: center;
    justify-content: center;
    display: flex
;">
                        <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Unknown User'; ?>
                    </p>
                    <hr style="border-color:#444;">
                    <a href="profile.php" style="color:white; text-decoration:none;">👤 My Profile</a><br><br>
                    <a href="my_playlist.php" style="color:white; text-decoration:none;">🎵 My Playlist</a><br><br>
                    <a href="liked_songs.php" style="color:white; text-decoration:none;">❤️ Liked Songs</a><br><br>
                    <a href="logout.php" style="color:white; text-decoration:none;">🚪 Logout</a>
                </div>
            </div>
        </div>
        <script>
            function toggleMenu() {
                const menu = document.getElementById('profileMenu');
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            }
        </script>

    </header>

    <h2>❤️ Your Liked Songs</h2>
    <div class="songs-container">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="song-card" data-audio="<?php echo htmlspecialchars($row['file_url']); ?>">

                    <div class="image-container">
                        <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="Playlist Image">
                        <div class="play-btn">▶</div>
                    </div>
                    <div class="song-info">
                        <h4><?php echo htmlspecialchars($row['song_name']); ?></h4>
                        <p class="meta"><?php echo htmlspecialchars($row['language']); ?></p>
                        <p style="font-size: 12px; color: #999;"><?php echo htmlspecialchars($row['description']); ?></p>
                        <a href="unlike_song.php" style="text-decoration: none; color:white" class="remove-btn" data-song-id="<?php echo $row['id']; ?>">❌ Remove</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center; color:gray;">No Liked Songs Found.</p>
        <?php endif; ?>
    </div>

    <div class="bottom-player" id="bottom-player" style="display: none; ">
        <div class="wrapper" style="display: flex;justify-content: space-between; ">
            <div class="player-left">
                <img src="uploads/sample.jpg" id="player-thumb">
                <div class="player-song-info">
                    <h4 id="player-song-name">Song Name Here</h4>
                    <p id="player-artist-name">Artist - 100K views • 5K likes</p>
                </div>
            </div>
            <div class="player-center">
                <button id="prev-btn">⏮</button>
                <button id="play-btn">▶</button>
                <button id="pause-btn" style="display: none;">⏸</button>
                <button id="next-btn">⏭</button>
                <span id="current-time">0:00</span> / <span id="duration">0:00</span>
            </div>
            <div class="player-right">
                <div class="player-right">
                    <button id="volume-down"><i class="ri-volume-down-line"></i></button>
                    <button id="volume-up"><i class="ri-volume-up-line"></i></button>
                    <input type="range" id="volume-slider" min="0" max="1" step="0.01" value="1" style="width: 80px;">
                </div>

                <button>🔁</button>
                <button>🔀</button>
                <button>❤️</button>
                <button>⋮</button>
                <audio id="audio-player" style="display: none;"></audio>
            </div>
        </div>
        <div class="progress-container" id="progress-container" style="margin-top: 3px;">
            <div class="progress" id="progress"></div>
        </div>
    </div>
    </div>


    <a href="user_song_list.php" class="back-btn">⬅ Back to Home</a>

    <script src="./script/liked.js"></script>
</body>

</html>