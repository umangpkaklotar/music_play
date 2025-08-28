<?php
session_start();
$loggedIn = isset($_SESSION['user_id']);
$userImage = $loggedIn ? $_SESSION['profile_img'] ?? 'img/user.png' : 'img/user.png';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Music Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/upgrade.css">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3>Menu</h3>
        <ul>
            <li>🏠 Home</li>
            <li>🔎 Explore</li>
            <li>📚 Library</li>
            <li>⬆ Upgrade</li>
            <a href="my_playlist.php" style="text-decoration: none; color:#fff;margin-left: 6%;">
                <i class="ri-play-list-line"> My Playlist</i>
            </a>
            <a href="liked_songs.php">
                <li>❤️ Liked</li>
            </a>
        </ul>
    </div>
    <div class="overlay" id="overlay"></div>

    <!-- Header -->
    <div class="header">
        <i class="ri-menu-line menu-icon" id="menuToggle"></i>
        <a href="user_song_list.php"><img src="image/logo.svg" alt=""></a>
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
                <div id="profileMenu" class="profileMenu" style="display:none; position: absolute; right: 0; background: #222; padding: 10px; border-radius: 10px; width: 10vw; ">
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

    </div>

    <!-- Main Content -->

    <div class="main-content">
        <h1>Get Music Premium to listen to music ad-free, offline and with your screen off</h1>
        <p class="subtext">Prepaid and monthly plans available. Starts at ₹119.00/month. Free trials with monthly plans.</p>
        <button class="premium-btn">Get Music Premium</button>
        <p class="plan-text">Or save money with a <a href="#">shared or student plan</a></p>
    </div>

    <!-- sction 1 ======================= -->
    <section class="features-section">
        <h2>Over 100M songs, videos, live performances <br>and more at your fingertips</h2>

        <div class="features-grid">
            <div class="feature">
                <img src="image/icon1.webp" alt="Ad Free Icon">
                <p>Listen ad-free to your favourite songs and artists</p>
            </div>
            <div class="feature">
                <img src="image/icon2.webp" alt="Offline Icon">
                <p>Download offline to listen on the go or play in the background for an uninterrupted experience</p>
            </div>
            <div class="feature">
                <img src="image/icon3.webp" alt="Switch Icon">
                <p>Switch from audio to video when listening to songs with just a tap</p>
            </div>
        </div>

        <h2>Pick a membership that fits you</h2>
    </section>


    <!-- section 2 ================= -->
    <section class="pricing-section">
        <div class="pricing-grid">
            <!-- Individual Plan -->
            <div class="pricing-card">
                <h3><i class="icon">👤</i> Individual</h3>
                <p class="sub">Prepaid or monthly</p>
                <p class="price">Starts at ₹119.00/month</p>
                <p class="note">Free trials with monthly plans</p>
                <button class="btn">Get Music Premium</button>
            </div>

            <!-- Family Plan -->
            <div class="pricing-card">
                <h3><i class="icon">👨‍👩‍👧‍👦</i> Family</h3>
                <p class="sub">Monthly</p>
                <p class="price">₹179.00/month</p>
                <p class="note">1-month trial for ₹0<br>Add up to 5 family members (aged 13+) in your household. <a href="#">Restrictions apply.</a></p>
                <button class="btn">Try 1 month for ₹0</button>
            </div>

            <!-- Two-Person Plan -->
            <div class="pricing-card">
                <h3><i class="icon">👥</i> Two-person</h3>
                <p class="sub">Monthly</p>
                <p class="price">₹149.00/month</p>
                <p class="note">1-month trial for ₹0<br>Add one other member (aged 13+) from your household. <a href="#">Restrictions apply.</a></p>
                <button class="btn">Try 1 month for ₹0</button>
            </div>

            <!-- Student Plan -->
            <div class="pricing-card">
                <h3><i class="icon">🎓</i> Student</h3>
                <p class="sub">Monthly</p>
                <p class="price">₹59.00/month</p>
                <p class="note">1-month trial for ₹0<br>Eligible students only. Annual verification required. <a href="#">Restrictions apply.</a></p>
                <button class="btn">Try 1 month for ₹0</button>
            </div>
        </div>

        <div class="footer-note">
            <h2>YouTube Music, your way</h2>
            <p>These features are available in the YouTube Music app without a subscription.</p>
        </div>
    </section>

    <!-- scetion 3 ========== -->
    <section class="section">
        <div class="top-text">
            <h1>Move to your own rhythm</h1>
            <p>Listen to mixes based on the music that you love and discover<br> thousands of other playlists curated to match any mood or moment.</p>
        </div>

        <div class="playlist-images">
            <img src="image/sid.webp" alt="Chill Supermix">

        </div>

        <div class="bottom-content">
            <div class="phone-mockup">
                <img src="image/phone.webp" alt="Phone Mockup">
            </div>

            <div class="text-content">
                <h2>Customise your listening experience</h2>
                <p>Combine your favourite artists and fine-tune your own music experience.</p>
            </div>
        </div>
    </section>
    <!-- scetion 4 =============== -->
    <section class="faq-section">
        <h1>Any questions? We're here to help.</h1>

        <div class="faq-item">
            <div class="faq-question">
                <span>How do I play videos and music in the background?</span>
                <span class="faq-toggle">&#9660;</span>
            </div>
            <div class="faq-answer">
                With a YouTube Music Premium plan, Background play is on by default on the YouTube Music app. This means that if you're listening to music or watching a music video and you close your screen or exit the app, your music will keep playing in the background until you pause it.
                <br /><br />
                <a href="#">Learn more about Background play</a>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>What products, services and devices support YouTube Music Premium?</span>
                <span class="faq-toggle">&#9660;</span>
            </div>
            <div class="faq-answer">
                The YouTube Music app is supported on devices like smartphones, laptops, tablets and smart TVs.
                <br />
                Check out our <a href="#">list of compatible products and services</a> to stay up to date.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>How many members can I add to a plan?</span>
                <span class="faq-toggle">&#9660;</span>
            </div>
            <div class="faq-answer">
                You can add up to 5 family members (ages 13+) in your household to your YouTube Music Premium Family Plan.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>How can I cancel my subscription?</span>
                <span class="faq-toggle">&#9660;</span>
            </div>
            <div class="faq-answer">
                You can cancel your subscription from the account settings at any time.
            </div>
        </div>

        <div class="faq-footer">
            Have other questions?<br />
            Visit the <a href="#">YouTube Help Centre</a>
        </div>
    </section>

    <script>
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
    </script>





    <!-- JavaScript for toggling -->
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
</body>

</html>