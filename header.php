<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$profile_img = isset($_SESSION['profile_img']) && !empty($_SESSION['profile_img'])
    ? 'uploads/' . htmlspecialchars($_SESSION['profile_img'])
    : 'img/default_profile.png';  // 👈 default profile image


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: 'Segoe UI', sans-serif;
            padding: 30px;
        }

        /* header */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background-color: #181818;
            color: white;
            position: fixed;
            width: 96vw;
            top: 0;
            height: 60px;
            z-index: 1000;
            margin-left: -4%;
        }

        .left-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 18px;
            color: white;
            margin-left: 55%;
        }

        .logo img {
            height: 60px;
            width: auto;
            filter: drop-shadow(0 0 8px #1db954);
            /* green glow to match background */
            transition: transform 0.3s ease;
            margin-left: 72px;
            margin-top: 15px;

        }


        .logo i {
            color: #ff3b3b;
            font-size: 24px;
        }

        .center-header {
            flex: 1;
            max-width: 500px;
            display: flex;
            align-items: center;
            background-color: #2b2b2b;
            border-radius: 30px;
            padding: 8px 15px;
            margin: 0 20px;
        }

        .center-header input {
            flex: 1;
            background: transparent;
            border: none;
            color: white;
            outline: none;
            padding: 5px 10px;
        }

        .center-header i {
            color: #aaa;
            margin-left: 10px;
            font-size: 18px;
        }

        .right-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .right-header i {
            color: #aaa;
            font-size: 20px;
            cursor: pointer;
        }

        .right-header img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .search-container {
            text-align: center;
            padding: 20px 0;
        }

        #searchInput {
            width: 46vw;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 30px;
            border: none;
            outline: none;
            background-color: #222;
            color: white;
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

    <script src="./script/header.js"></script>


</body>

</html>