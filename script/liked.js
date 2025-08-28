const audioPlayer = document.getElementById('audio-player');
const bottomPlayer = document.getElementById('bottom-player');
const playBtn = document.getElementById('play-btn');
const pauseBtn = document.getElementById('pause-btn');
const progressContainer = document.getElementById('progress-container');
const progress = document.getElementById('progress');
const playerSongName = document.getElementById('player-song-name');
const playerArtistName = document.getElementById('player-artist-name');
const playerThumb = document.getElementById('player-thumb');
const currentTime = document.getElementById('current-time');
const durationTime = document.getElementById('duration');
const nextBtn = document.getElementById('next-btn');
const prevBtn = document.getElementById('prev-btn');
const volumeDownBtn = document.getElementById('volume-down');
const volumeUpBtn = document.getElementById('volume-up');
const volumeSlider = document.getElementById('volume-slider');
const searchInput = document.getElementById('searchInput');

let songCards = Array.from(document.querySelectorAll('.song-card'));
let currentSongIndex = -1;

songCards.forEach((card, index) => {
    card.addEventListener('click', () => {
        currentSongIndex = index;
        loadSong(index);
    });
});


function loadSong(index) {
    const card = songCards[index];
    if (!card) return;
    const audioSrc = card.getAttribute('data-audio');
    const songName = card.querySelector('h4').innerText;
    const songMeta = card.querySelector('.meta').innerText;
    const songImg = card.querySelector('img').src;

    audioPlayer.src = audioSrc;
    playerSongName.textContent = songName;
    playerArtistName.textContent = songMeta;
    playerThumb.src = songImg;

    bottomPlayer.style.display = 'block';
    audioPlayer.play();
    playBtn.style.display = 'none';
    pauseBtn.style.display = 'inline';
}

songCards.forEach((card, index) => {
    const playButton = card.querySelector('.play-btn');

    card.addEventListener('click', () => {
        currentSongIndex = index;
        loadSong(currentSongIndex);
    });

    if (playButton) {
        playButton.addEventListener('click', e => {
            e.stopPropagation();
            currentSongIndex = index;
            loadSong(currentSongIndex);
        });
    }
});

playBtn.addEventListener('click', () => {
    audioPlayer.play();
    playBtn.style.display = 'none';
    pauseBtn.style.display = 'inline';
});

pauseBtn.addEventListener('click', () => {
    audioPlayer.pause();
    playBtn.style.display = 'inline';
    pauseBtn.style.display = 'none';
});

audioPlayer.addEventListener('pause', () => {
    if (audioPlayer.currentTime === 0) {
        bottomPlayer.style.display = 'none';
    }
});

nextBtn.addEventListener('click', () => {
    currentSongIndex = (currentSongIndex + 1) % songCards.length;
    loadSong(currentSongIndex);
});

prevBtn.addEventListener('click', () => {
    currentSongIndex = (currentSongIndex - 1 + songCards.length) % songCards.length;
    loadSong(currentSongIndex);
});

audioPlayer.addEventListener('timeupdate', () => {
    const progressPercent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    progress.style.width = `${progressPercent}%`;
    currentTime.textContent = formatTime(audioPlayer.currentTime);
    durationTime.textContent = formatTime(audioPlayer.duration);
});

// ✅ Auto Play Next Song on End
audioPlayer.addEventListener('ended', () => {
    currentSongIndex = (currentSongIndex + 1) % songCards.length;
    loadSong(currentSongIndex);
});


progressContainer.addEventListener('click', (e) => {
    const width = progressContainer.clientWidth;
    const clickX = e.offsetX;
    audioPlayer.currentTime = (clickX / width) * audioPlayer.duration;
});

function formatTime(seconds) {
    if (isNaN(seconds)) return '0:00';
    const m = Math.floor(seconds / 60);
    const s = Math.floor(seconds % 60);
    return `${m}:${s < 10 ? '0' : ''}${s}`;
}

volumeDownBtn.addEventListener('click', () => {
    audioPlayer.volume = Math.max(0, audioPlayer.volume - 0.1);
    volumeSlider.value = audioPlayer.volume;
});

volumeUpBtn.addEventListener('click', () => {
    audioPlayer.volume = Math.min(1, audioPlayer.volume + 0.1);
    volumeSlider.value = audioPlayer.volume;
});
volumeSlider.addEventListener('input', () => {
    audioPlayer.volume = volumeSlider.value;
});
// unlikes mate
document.querySelectorAll('.remove-btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        const songId = this.dataset.songId;
        const card = this.closest('.song-card');

        if (confirm("Remove this song from your playlist?")) {
            fetch('unlike_song.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'song_id=' + songId
            })
                .then(res => res.text())
                .then(data => {
                    if (data.trim() === "success") {
                        card.remove(); // ✅ UI maathi remove
                    } else {
                        alert("Failed to remove song: " + data);
                    }
                })
                .catch(err => {
                    alert("Error removing song.");
                    console.error(err);
                });
        }
    });
});

// Live search filtering
searchInput.addEventListener('keyup', () => {
    const filter = searchInput.value.toLowerCase().split(" ");

    songCards.forEach(card => {
        const text = card.textContent.toLowerCase();
        const isMatch = filter.some(word => word && text.includes(word));

        if (isMatch || filter.length === 0) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});