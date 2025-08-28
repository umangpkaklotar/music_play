<!-- player.php -->
<div id="music-player">
    <audio id="audio" controls autoplay></audio>
</div>

<script>
    // Restore from localStorage
    const audio = document.getElementById('audio');
    const song = localStorage.getItem('current_song');
    const songTime = localStorage.getItem('song_time') || 0;

    if (song) {
        audio.src = song;
        audio.currentTime = songTime;
        audio.play();
    }

    // Save song progress
    audio.addEventListener('timeupdate', () => {
        localStorage.setItem('song_time', audio.currentTime);
    });

    // Save song URL when new one set
    audio.addEventListener('play', () => {
        localStorage.setItem('current_song', audio.src);
    });

    // Clear on end
    audio.addEventListener('ended', () => {
        localStorage.removeItem('current_song');
        localStorage.removeItem('song_time');
    });

    // Listen for play request
    window.addEventListener("message", function (event) {
        if (event.data.type === "play-song") {
            audio.src = event.data.url;
            audio.play();
            localStorage.setItem('current_song', event.data.url);
            localStorage.setItem('song_time', 0);
        }
    });
</script>

<style>
    #music-player {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #222;
        padding: 10px;
        z-index: 9999;
    }
</style>
