<?php

session_start();
include 'db.php';
$json = file_get_contents("http://localhost/music/music_api.php");
$songs = json_decode($json, true);
// include 'music_api.php';

$filter = isset($_GET['category']) ? $_GET['category'] : '';

$sql = "SELECT song.*, artists.artist_name, albums.album_name 
        FROM song 
        LEFT JOIN artists ON song.artist_id = artists.id 
        LEFT JOIN albums ON song.album_id = albums.id";

if ($filter != '') {
    $cat = $conn->real_escape_string($filter);
    $sql .= " WHERE song.language = '$cat'";
}

$result = $conn->query($sql);

// if (!isset($_SESSION['user_id'])) {
//     echo "<script>alert('Please login to listen music!'); window.location.href = 'login.php';</script>";
//     exit();
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Music Player</title>
    <link rel="stylesheet" href="style.css">
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/three@0.152.0/build/three.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <link rel="stylesheet" href="./css/user_song_list.css">
    <style>
        .categories button.active {
            background: #1db954;
            color: #fff;
            font-weight: bold;
        }

        body {
            margin: 0;
            background: #000;
            color: white;
            overflow-x: hidden;
            position: relative;
        }

        /* Disco Background */
        #disco-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle, rgba(255, 0, 150, 0.3) 10%, transparent 70%) 0 0,
                radial-gradient(circle, rgba(0, 255, 150, 0.3) 10%, transparent 70%) 50% 50%,
                radial-gradient(circle, rgba(0, 150, 255, 0.3) 10%, transparent 70%) 100% 100%;
            background-size: 200% 200%;
            mix-blend-mode: screen;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        /* Sidebar Disco Effect */
        .sidebar {
            background: rgba(0, 0, 0, 0.8);
            position: relative;
            overflow: hidden;
        }

        .sidebar::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, #ff0077, #00ffcc, #00aaff, #ff0077);
            animation: rotateDisco 6s linear infinite;
            opacity: 0.2;
            z-index: -1;
        }

        @keyframes rotateDisco {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

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
    <!-- HEADER -->
    <!-- HEADER -->
    <!-- <canvas id="bg-canvas"></canvas> -->
    <!-- <div id="disco-bg"></div> -->

    <video autoplay loop muted playsinline id="bg-video">
        <source src="https://cdn.prod.website-files.com/5f045d2f34d91988db9ec750/5f0c2839838516b7a570a3c1_MH-BG_v7-transcode.mp4" type="video/mp4">
        <source src="https://cdn.prod.website-files.com/5f045d2f34d91988db9ec750/5f0c2839838516b7a570a3c1_MH-BG_v7-transcode.webm" type="video/webm">
    </video>

    <header class="top-header">
        <div class="left-header">
            <button class="toggle-btn" id="toggle-btn">☰</button>
            <div class="logo">
                <a href="user_song_list.php"><img src="image/my.png" alt=""></a>
            </div>
            <!-- <button id="light-btn" class="theme-btn">☀️</button>
            <button id="dark-btn" class="theme-btn">🌙</button> -->
        </div>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search song / artist / album...">
        </div>
        <div class="right-header">
            <i class="ri-cast-line"></i>
            <div class="pro" style="position: relative;">
                <img src="uploads/<?php echo isset($_SESSION['profile_img']) ? htmlspecialchars($_SESSION['profile_img']) : 'default.png'; ?>"
                    alt="Profile"
                    style="width: 40px; height: 40px; border-radius: 50%; cursor:pointer;"
                    onclick="toggleMenu()">
                <div id="profileMenu" class="profileMenu" style="display:none; position: absolute; right: 0; background: #222; padding: 10px; border-radius: 10px; width: 10vw; ">
                    <p style="color:#1db954;     align-items: center;justify-content: center; display: flex;">
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


    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">

        <ul>
            <li><i class="ri-home-4-line"></i> Home</li>
            <li>🔎 Explore</li>
            <li>📚 Library</li>
            <a href="Upgrade.php" style="text-decoration: none; color:#fff;">
                <li>⬆ Upgrade</li>
            </a>
            <a href="my_playlist.php" style="text-decoration: none; color:#fff;">
                <i class="ri-play-list-line"> My Playlist</i>
            </a>
            <a href="liked_songs.php" style="text-decoration: none; color:#fff;">
                <li><i class="ri-heart-3-line"></i> Liked</li>
            </a>
        </ul>
    </div>


    <div class="main-content" id="main-content">
        <div class="header">
            <h1>My Music</h1>
            <p>Discover & Listen to your Favorite Songs</p>
        </div>


        <?php $active = isset($_GET['category']) ? $_GET['category'] : ''; ?>

        <div class="categories">
            <a href="user_song_list.php"><button <?= $active == '' ? 'class="active"' : '' ?>>All</button></a>
            <a href="user_song_list.php?category=Podcasts"><button <?= $active == 'Podcasts' ? 'class="active"' : '' ?>>Podcasts</button></a>
            <a href="user_song_list.php?category=Romance"><button <?= $active == 'Romance' ? 'class="active"' : '' ?>>Romance</button></a>
            <a href="user_song_list.php?category=Relax"><button <?= $active == 'Relax' ? 'class="active"' : '' ?>>Relax</button></a>
            <a href="user_song_list.php?category=Feel good"><button <?= $active == 'Feel good' ? 'class="active"' : '' ?>>Feel good</button></a>
            <a href="user_song_list.php?category=Energise"><button <?= $active == 'Energise' ? 'class="active"' : '' ?>>Energise</button></a>
            <a href="user_song_list.php?category=Commute"><button <?= $active == 'Commute' ? 'class="active"' : '' ?>>Commute</button></a>
            <a href="user_song_list.php?category=Party"><button <?= $active == 'Party' ? 'class="active"' : '' ?>>Party</button></a>
            <a href="user_song_list.php?category=Work out"><button <?= $active == 'Work out' ? 'class="active"' : '' ?>>Work out</button></a>
            <a href="user_song_list.php?category=Sad"><button <?= $active == 'Sad' ? 'class="active"' : '' ?>>Sad</button></a>
            <a href="user_song_list.php?category=Focus"><button <?= $active == 'Focus' ? 'class="active"' : '' ?>>Focus</button></a>

            <a href="user_song_list.php?category=Sleep"><button <?= $active == 'Sleep' ? 'class="active"' : '' ?>>Sleep</button></a>
            <a href="user_song_list.php?category=Englies"><button <?= $active == 'Englies' ? 'class="active"' : '' ?>>Englies</button></a>
            <!-- 🔥 Hindi / Gujarati / Rep (Rap) Add -->
            <a href="user_song_list.php?category=Hindi"><button <?= $active == 'Hindi' ? 'class="active"' : '' ?>>Hindi</button></a>
            <a href="user_song_list.php?category=Gujarati"><button <?= $active == 'Gujarati' ? 'class="active"' : '' ?>>Gujarati</button></a>
            <a href="user_song_list.php?category=Rep"><button <?= $active == 'Rep' ? 'class="active"' : '' ?>>Rap</button></a>
        </div>


        <h2>Featured Songs</h2>

        <div class="songs-container">
            <?php if ($result->num_rows > 0): ?>
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
                            <a href="playlist_songs.php?song_id=<?php echo $row['id']; ?>" class="playlist-btn" onclick="return playlistAlert()">+ Add to Playlist</a>
                            <a href="like_song.php?song_id=<?php echo $row['id']; ?>" class="like-btn" onclick="return likeAlert()">❤️ Like</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No songs available.</p>
            <?php endif; ?>
        </div>

        <script>
            function playlistAlert() {
                alert('🎵 Song added to playlist successfully!');
                return true; // allow link to redirect
            }

            function likeAlert() {
                alert('❤️ Song liked successfully!');
                return true; // allow link to redirect
            }
        </script>


        <!-- Audio Element (Hidden) -->
        <!-- FIXED BOTTOM MUSIC PLAYER -->


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


    <script src="./script/user_song_list.js"></script>

</body>

</html>