const toggleBtn = document.getElementById('toggle-btn');
const sidebar = document.getElementById('sidebar');

sidebar.classList.remove('show'); // Start Hidden

// ✅ Toggle sidebar on button click
toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('show');
});

// ✅ Hide sidebar automatically on scroll
let lastScroll = 0;
window.addEventListener('scroll', () => {
    let currentScroll = window.scrollY;
    if (currentScroll > lastScroll) {
        sidebar.classList.remove('show'); // Hide when scrolling down
    }
    lastScroll = currentScroll;
});

// sidebar toggole 

const searchInput = document.getElementById('searchInput');
searchInput.addEventListener('keyup', function () {
    let filter = searchInput.value.toLowerCase().split(" ");
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

// Audio Player Elements
const audioPlayer = document.getElementById('audio-player');
const bottomPlayer = document.getElementById('bottom-player');
const playButtons = document.querySelectorAll('.play-btn');
const playerSongName = document.getElementById('player-song-name');
const playerArtistName = document.getElementById('player-artist-name');
const playerThumb = document.getElementById('player-thumb');
const playBtn = document.getElementById('play-btn');
const pauseBtn = document.getElementById('pause-btn');
const currentTime = document.getElementById('current-time');
const durationTime = document.getElementById('duration');
const progressContainer = document.getElementById('progress-container');
const progress = document.getElementById('progress');
const nextBtn = document.getElementById('next-btn');
const prevBtn = document.getElementById('prev-btn');
const volumeDownBtn = document.getElementById('volume-down');
const volumeUpBtn = document.getElementById('volume-up');
const volumeSlider = document.getElementById('volume-slider');

let songCards = Array.from(document.querySelectorAll('.song-card'));
let currentSongIndex = -1;

function formatTime(seconds) {
    if (isNaN(seconds)) return '0:00';
    const m = Math.floor(seconds / 60);
    const s = Math.floor(seconds % 60);
    return `${m}:${s < 10 ? '0' : ''}${s}`;
}

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

    // Show bottom player
    bottomPlayer.style.display = 'block';
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
    bottomPlayer.style.display = 'flex';
});

pauseBtn.addEventListener('click', () => {
    audioPlayer.pause();
    playBtn.style.display = 'inline';
    pauseBtn.style.display = 'none';
});

audioPlayer.addEventListener('timeupdate', () => {
    const progressPercent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    progress.style.width = `${progressPercent}%`;
    currentTime.textContent = formatTime(audioPlayer.currentTime);
    durationTime.textContent = formatTime(audioPlayer.duration);
});

audioPlayer.addEventListener('pause', () => {
    // Only hide if song hasn't started playing
    if (audioPlayer.currentTime === 0 || audioPlayer.ended) {
        bottomPlayer.style.display = 'none';
    }
});

// ✅ Auto Play Next Song on End
audioPlayer.addEventListener('ended', () => {
    currentSongIndex = (currentSongIndex + 1) % songCards.length;
    loadSong(currentSongIndex);
});


progressContainer.addEventListener('click', (e) => {
    const width = progressContainer.clientWidth;
    const clickX = e.offsetX;
    const duration = audioPlayer.duration;
    audioPlayer.currentTime = (clickX / width) * duration;
});

nextBtn.addEventListener('click', () => {
    currentSongIndex = (currentSongIndex + 1) % songCards.length;
    loadSong(currentSongIndex);
});

prevBtn.addEventListener('click', () => {
    currentSongIndex = (currentSongIndex - 1 + songCards.length) % songCards.length;
    loadSong(currentSongIndex);
});

// Volume control
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

// dark ane light mood
const body = document.body;
const lightBtn = document.getElementById('light-btn');
const darkBtn = document.getElementById('dark-btn');

// Load saved theme
if (localStorage.getItem('theme') === 'light') {
    body.classList.add('light-mode');
}

// Switch to Light Mode
lightBtn.addEventListener('click', () => {
    body.classList.add('light-mode');
    localStorage.setItem('theme', 'light');
});

// Switch to Dark Mode
darkBtn.addEventListener('click', () => {
    body.classList.remove('light-mode');
    localStorage.setItem('theme', 'dark');
});


// thre js
let scene = new THREE.Scene();
let camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
let renderer = new THREE.WebGLRenderer({ canvas: document.getElementById("bgCanvas"), antialias: true });
renderer.setSize(window.innerWidth, window.innerHeight);

let geometry = new THREE.PlaneGeometry(5, 5, 50, 50);
let material = new THREE.MeshBasicMaterial({ color: 0x1db954, wireframe: true });
let plane = new THREE.Mesh(geometry, material);
scene.add(plane);
camera.position.z = 3;

function animate() {
    requestAnimationFrame(animate);
    plane.rotation.x += 0.002;
    plane.rotation.y += 0.003;
    renderer.render(scene, camera);
}
animate();

window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});

// scroling bar
const cards = document.querySelectorAll('.song-card');
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.transform = "translateY(0)";
            entry.target.style.opacity = "1";
        }
    });
}, { threshold: 0.2 });

cards.forEach(card => {
    card.style.transform = "translateY(50px)";
    card.style.opacity = "0";
    card.style.transition = "all 0.6s ease";
    observer.observe(card);
});


// 

document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll('.song-card');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    cards.forEach(card => observer.observe(card));
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

