const API_BASE = 'http://localhost:121/project1/ASE-230-Project-1/code/endpoints.inc.php';
let currentToken = null;

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

async function getByName() {
    const id = document.getElementById('search-id').value;
    try {
        const response = await fetch(`${API_BASE}/search/${id}`);
        const data = await response.json();
        document.getElementById('search-result').textContent = JSON.stringify(data, null, 2);
    } catch (error) {
        document.getElementById('search-result').textContent = 'Error: ' + error.message;
    }
}

async function createNewUser() {
    const newUserData = {
        name: document.getElementById('newUser-id').value,
        password: document.getElementById('newUserPass-id').value
    };

    try {
        const response = await fetch(`${API_BASE}/user`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
            body: JSON.stringify(newUserData)
        });
        const data = await response.json();
        document.getElementById('newUser-result').textContent = JSON.stringify(data, null, 2);
    } catch (error) {
        document.getElementById('newUser-result').textContent = 'Error: ' + error.message;
    }
}

async function loginUser() {
    const userData = {
        username: document.getElementById('username-login').value,
        password: document.getElementById('password-login').value
    };

    try {
        const response = await fetch(`${API_BASE}/login`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
            body: JSON.stringify(userData)
        });

        const data = await response.json();

        if(response.ok) {
            currentToken = data.token;

            document.getElementById('login-result').textContent = JSON.stringify(data, null, 2);
            document.getElementById('token-value').textContent = currentToken;
        } else {
            document.getElementById('login-result').textContent = 'Error: ' + error.message;
        }

    } catch (error) {
        document.getElementById('login-result').textContent = 'Error: ' + error.message;
    }
}

async function createNewSong() {
    const userData = {
        songName: document.getElementById('newSong-name').value,
        songArtist: document.getElementById('newSong-artist').value,
        songLength: document.getElementById('newSong-length').value,
        songAuth: document.getElementById('newSong-auth').value
    };

    try {
        const response = await fetch(`${API_BASE}/song`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
            body: JSON.stringify(userData)
        });

        const data = await response.json();
        document.getElementById('newSong-result').textContent = JSON.stringify(data, null, 2);
    } catch (error) {
        document.getElementById('newSong-result').textContent = 'Error: ' + error.message;
    }
}
    
async function createNewPlaylist() {
    const userData = {
        userID: document.getElementById('newPlaylist-user').value,
        playlistAuth: document.getElementById('newPlaylist-auth').value
    };

    try {
        const response = await fetch(`${API_BASE}/playlist`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
            body: JSON.stringify(userData)
        });

        const data = await response.json();
        document.getElementById('newPlaylist-result').textContent = JSON.stringify(data, null, 2);
    } catch (error) {
        document.getElementById('newPlaylist-result').textContent = 'Error: ' + error.message;
    }
}

async function addSongToPlaylist() {
    const userData = {
        playlistID: document.getElementById('modifyPlaylist-playlistID').value,
        songID: document.getElementById('modifyPlaylist-songID').value,
        playlistAuth: document.getElementById('modifyPlaylist-auth').value
    };

    try {
        const response = await fetch(`${API_BASE}/playlist`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
            body: JSON.stringify(userData)
        });

        const data = await response.json();
        document.getElementById('modifyPlaylist-result').textContent = JSON.stringify(data, null, 2);
    } catch (error) {
        document.getElementById('modifyPlaylist-result').textContent = 'Error: ' + error.message;
    }
}