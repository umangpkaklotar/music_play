const audio = document.getElementById('audio');
const title = document.getElementById('title');
const artist = document.getElementById('artist');
const songList = document.querySelectorAll('#songList li');

songList.forEach(song => {
    song.addEventListener('click', () => {
        const file = song.getAttribute('data-file');
        const name = song.getAttribute('data-name');
        const artistName = song.getAttribute('data-artist');

        audio.src = file;
        title.textContent = name;
        artist.textContent = artistName;
        audio.play();
    });
});
