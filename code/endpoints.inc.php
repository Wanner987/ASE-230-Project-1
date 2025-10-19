<?php
require_once 'sqlconnection.inc.php';
require_once 'bearer_auth.php'; 


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Parse the URL path
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');

$segments = explode('/', $path); //seperate the path into array by /
$resource = $segments[4] ?? ''; //what is being looked up (artist, user, song, playlist)
$id = $segments[5] ?? null; 

$method = $_SERVER['REQUEST_METHOD']; //GET POST PUT DELETE

if ($resource === 'artist') {
    $artist_id = isset($id) ? (int)$id : null;

    switch($method) {
        case 'GET':
            if ($artist_id) {
                $artistName = getArtistByID($artist_id)[0];
                echo json_encode([
                    'success' => true,
                    'name' => $artistName
                ]);
                exit;
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Artist ID required']);
            }
            break;
        case 'POST':
            break;
        case 'PUT':
            break;
        case 'DELETE':
            break;
        
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    } 
} 

if ($resource === 'song') {
    $song_id = isset($id) ? (int)$id : null;

    switch($method) {
        case 'GET':
            if ($song_id) {
                $songName = getSongByID($song_id)[0];
                echo json_encode([
                    'success' => true,
                    'name' => $songName
                ]);
                exit;
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Song ID required']);
            }
            break;
        case 'POST':
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (!isset($data['songName']) || empty($data['songName'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Name is required']);
                exit;
            }

            if (!isset($data['songArtist']) || empty($data['songArtist'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Artist is required']);
                exit;
            }

            if (!isset($data['songAuth']) || empty($data['songAuth'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Auth is required']);
                exit;
            }

            $songName = $data['songName'];
            $songArtist = $data['songArtist'];
            $songLength = $data['songLength'];
            $auth = $data['songAuth'];

            if(!isValidToken($auth)) {
                http_response_code(400);
                echo json_encode(['error' => 'Auth is wrong']);
                exit;
            }

            $newSongID = createNewSong($songName, $songArtist, $songLength);

            echo json_encode([
            'success' => true,
            'new ID' => $newSongID
            ]);
            exit;

            break;
        case 'PUT':
            break;
        case 'DELETE':
            break;
        
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    } 
} 

if ($resource === 'playlist') {
    $playlist_id = isset($id) ? (int)$id : null;

    switch($method) {
        case 'GET':
            if ($playlist_id) {
                $playlistArray = getPlaylistByID($playlist_id);
                echo json_encode([
                    'success' => true,
                    'name' => $playlistArray
                ]);
                exit;
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Song ID required']);
            }
            break;
        case 'POST':
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (!isset($data['userID']) || empty($data['userID'])) {
                http_response_code(400);
                echo json_encode(['error' => 'User ID is required']);
                exit;
            }

            if (!isset($data['playlistAuth']) || empty($data['playlistAuth'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Auth is required']);
                exit;
            }

            $userID = $data['userID'];
            $auth = $data['playlistAuth'];

            if (getUserByID($userID)[0] == 'error no row found') {
                http_response_code(400);
                echo json_encode(['error' => 'user ID is incorrect']);
                exit;
            }
            
            if(!isValidToken($auth)) {
                http_response_code(400);
                echo json_encode(['error' => 'Auth is wrong']);
                exit;
            }

            $newPlaylistID = createNewPlaylist($userID);

            echo json_encode([
            'success' => true,
            'new ID' => $newPlaylistID
            ]);
            exit;

            break;
        case 'PUT':
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (!isset($data['playlistID']) || empty($data['playlistID'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Playlist ID is required']);
                exit;
            }

            if (!isset($data['songID']) || empty($data['songID'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Song ID is required']);
                exit;
            }

            if (!isset($data['playlistAuth']) || empty($data['playlistAuth'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Auth is required']);
                exit;
            }

            
            $playlistID = $data['playlistID'];
            $songID = $data['songID'];
            $auth = $data['playlistAuth'];

            if (getPlaylistByID($playlistID)[0] == 'error no row found') {
                http_response_code(400);
                echo json_encode(['error' => 'playlist ID is incorrect']);
                exit;
            }

            if (getSongByID($songID)[0] == 'error no row found') {
                http_response_code(400);
                echo json_encode(['error' => 'song ID is incorrect']);
                exit;
            }

            if(!isValidToken($auth)) {
                http_response_code(400);
                echo json_encode(['error' => 'Auth is wrong']);
                exit;
            }

            $message = addSongToPlaylist($playlistID, $songID);

            echo json_encode([
            'success' => true,
            'message' => $message
            ]);
            exit;

            
            break;
        case 'DELETE':
            break;
        
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    } 
} 

if ($resource === 'user') {
    $user_id = isset($id) ? (int)$id : null;

    switch($method) {
        case 'GET':
            if ($user_id) {
                $username = getUserByID($user_id)[0];
                echo json_encode([
                    'success' => true,
                    'name' => $username
                ]);
                exit;
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Song ID required']);
            }
            break;
        case 'POST':
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            

            if (!isset($data['name']) || empty($data['name'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Name is required']);
            exit;
            }
            


            if (!isset($data['password']) || empty($data['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Password is required']);
            exit;
            }
            
            $newID = createNewUser($data['name'], $data['password']);

            echo json_encode([
            'success' => true,
            'new ID' => $newID
            ]);
            exit;

            break;
        case 'PUT':
            break;
        case 'DELETE':
            break;
        
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    } 
} 

if ($resource === 'search') {
    $search_id = isset($id) ? (string)$id : null;

    switch($method) {
        case 'GET':
            if ($search_id) {
                $matches = getSongByName($search_id);
                echo json_encode([
                    'success' => true,
                    'name' => $matches
                ]);
                exit;
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Song Name required']);
            }
            break;
        case 'POST':
            break;
        case 'PUT':
            break;
        case 'DELETE':
            break;
        
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
    } 
} 

if ($resource === 'login') {
    if ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['username']) || !isset($input['password'])) {
            sendJsonError(400, 'Username and password required');
        }

        $username = $input['username'];
        $password = $input['password'];
        
        if (!checkCredentials($username, $password)) {
            echo json_encode([
            'success' => false,
            ]);
            exit;
        }
        
        $token = 'ThisIsAToken(shouldBeMoreSecure)';


        echo json_encode([
            'success' => true,
            'token' => $token,
            'name' => $username
        ]);
        exit;
        } else {
            echo json_encode([
                'success' => true,
                'message' => 'Login endpoint'
        ]);
    }
}
exit;
?>