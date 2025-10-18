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