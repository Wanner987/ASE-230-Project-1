const API_BASE = 'http://localhost:121/project1/ASE-230-Project-1/code/endpoints.inc.php';

async function getArtistByID() {
    const id = document.getElementById('artist-id').value;
    try {
        const response = await fetch(`${API_BASE}/artist/${id}`);
        const data = await response.json();
        document.getElementById('artist-id-result').textContent = JSON.stringify(data, null, 2);
    } catch (error) {
        document.getElementById('artist-id-result').textContent = 'Error: ' + error.message;
    }
}

async function getSongByID() {
    const id = document.getElementById('song-id').value;
    try {
        const response = await fetch(`${API_BASE}/song/${id}`);
        const data = await response.json();
        document.getElementById('Song-id-result').textContent = JSON.stringify(data, null, 2);
    } catch (error) {
        document.getElementById('Song-id-result').textContent = 'Error: ' + error.message;
    }
}

async function getUserByID() {
    const id = document.getElementById('user-id').value;
    try {
        const response = await fetch(`${API_BASE}/user/${id}`);
        const data = await response.json();
        document.getElementById('user-id-result').textContent = JSON.stringify(data, null, 2);
    } catch (error) {
        document.getElementById('user-id-result').textContent = 'Error: ' + error.message;
    }
}

async function getPlaylistByID() {
    const id = document.getElementById('playlist-id').value;
    try {
        const response = await fetch(`${API_BASE}/playlist/${id}`);
        const data = await response.json();
        document.getElementById('playlist-id-result').textContent = JSON.stringify(data, null, 2);
    } catch (error) {
        document.getElementById('playlist-id-result').textContent = 'Error: ' + error.message;
    }
}