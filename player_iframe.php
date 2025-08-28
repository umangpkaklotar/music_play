<!-- player_iframe.php -->
<div class="bottom-player" id="bottom-player">
    <audio id="audio-player" src="" autoplay controls></audio>
</div>

<script>
    // Restore song if saved
    const savedSong = localStorage.getItem('song_url');
    const audioPlayer = document.getElementById('audio-player');

    if (savedSong) {
        audioPlayer.src = savedSong;
        audioPlayer.currentTime = localStorage.getItem('song_time') || 0;
    }

    audioPlayer.addEventListener('timeupdate', () => {
        localStorage.setItem('song_time', audioPlayer.currentTime);
    });

    audioPlayer.addEventListener('play', () => {
        localStorage.setItem('song_url', audioPlayer.src);
    });

    audioPlayer.addEventListener('ended', () => {
        localStorage.removeItem('song_url');
        localStorage.removeItem('song_time');


    });
</script>
<script>
    window.addEventListener('message', function(event) {
        if (event.data.type === 'play') {
            const audioPlayer = document.getElementById('audio-player');
            audioPlayer.src = event.data.src;
            audioPlayer.play();
            localStorage.setItem('song_url', event.data.src);
        }
    });
</script>

<style>
    .bottom-player {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #222;
        z-index: 9999;
        padding: 10px;
    }
</style>