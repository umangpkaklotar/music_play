const playButtons = document.querySelectorAll('.play-btn');
const playerSongName = document.getElementById('player-song-name');
const playerArtistName = document.getElementById('player-artist-name');
const playerThumb = document.getElementById('player-thumb');
const playBtn = document.getElementById('play-btn');
const pauseBtn = document.getElementById('pause-btn');
const currentTime = document.getElementById('current-time');
const durationTime = document.getElementById('duration');

playButtons.forEach(button => {
    button.addEventListener('click', function (e) {
        e.stopPropagation();
        const card = this.closest('.song-card');
        const audioSrc = card.getAttribute('data-audio');
        const songName = card.querySelector('h4').innerText;
        const songMeta = card.querySelector('.meta').innerText;
        const songImg = card.querySelector('img').src;

        audioPlayer.src = audioSrc;
        audioPlayer.style.display = 'block';
        audioPlayer.src = "your_audio_file.mp3";
        audioPlayer.play();

        playerSongName.textContent = songName;
        playerArtistName.textContent = songMeta + ' | Playing Now';
        playerThumb.src = songImg;
        playBtn.style.display = 'none';
        pauseBtn.style.display = 'inline';
    });
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

audioPlayer.addEventListener('timeupdate', () => {
    currentTime.textContent = formatTime(audioPlayer.currentTime);
    durationTime.textContent = formatTime(audioPlayer.duration);
});

function formatTime(seconds) {
    if (isNaN(seconds)) return '0:00';
    const m = Math.floor(seconds / 60);
    const s = Math.floor(seconds % 60);
    return `${m}:${s < 10 ? '0' : ''}${s}`;
}

// 
const progressContainer = document.getElementById('progress-container');
const progress = document.getElementById('progress');
const nextBtn = document.getElementById('next-btn');
const prevBtn = document.getElementById('prev-btn');

let songCards = Array.from(document.querySelectorAll('.song-card'));
let currentSongIndex = -1;

function loadSong(index) {
    const card = songCards[index];
    if (!card) return;
    const audioSrc = card.getAttribute('data-audio');
    const songName = card.querySelector('h4').innerText;
    const songMeta = card.querySelector('.meta').innerText;
    const songImg = card.querySelector('img').src;

    audioPlayer.src = audioSrc;
    playerSongName.textContent = songName;
    playerArtistName.textContent = songMeta + ' | Playing Now';
    playerThumb.src = songImg;
    audioPlayer.play();
    playBtn.style.display = 'none';
    pauseBtn.style.display = 'inline';
}

playButtons.forEach((button, index) => {
    button.addEventListener('click', (e) => {
        e.stopPropagation();
        currentSongIndex = index;
        loadSong(currentSongIndex);
    });
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

progressContainer.addEventListener('click', (e) => {
    const width = progressContainer.clientWidth;
    const clickX = e.offsetX;
    const duration = audioPlayer.duration;
    audioPlayer.currentTime = (clickX / width) * duration;
});

function formatTime(seconds) {
    if (isNaN(seconds)) return '0:00';
    const m = Math.floor(seconds / 60);
    const s = Math.floor(seconds % 60);
    return `${m}:${s < 10 ? '0' : ''}${s}`;
}


// sound
const volumeDownBtn = document.getElementById('volume-down');
const volumeUpBtn = document.getElementById('volume-up');

volumeDownBtn.addEventListener('click', () => {
    audioPlayer.volume = Math.max(0, audioPlayer.volume - 0.1);
    volumeSlider.value = audioPlayer.volume;
});

volumeUpBtn.addEventListener('click', () => {
    audioPlayer.volume = Math.min(1, audioPlayer.volume + 0.1);
    volumeSlider.value = audioPlayer.volume;
});

// sidebar
const toggleBtn = document.getElementById('toggle-btn');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('main-content');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('hidden');
    mainContent.classList.toggle('full');
});

const searchInput = document.getElementById('searchInput');
searchInput.addEventListener('keyup', function () {
    let filter = searchInput.value.toLowerCase().split(" "); // Split user input by space
    let songCards = document.querySelectorAll('.song-card');

    songCards.forEach(card => {
        let text = card.textContent.toLowerCase();
        let isMatch = false;

        filter.forEach(word => {
            if (word && text.includes(word)) {
                isMatch = true;
            }
        });

        if (isMatch || filter == "") {
            card.style.visibility = 'visible';
            card.style.position = 'relative';
        } else {
            card.style.visibility = 'hidden';
            card.style.position = 'absolute';
        }
    });
});

// play to strt
audioPlayer.addEventListener('pause', () => {
    if (audioPlayer.currentTime === 0) {
        document.getElementById('bottom-player').style.display = 'none';
    }
});