<?php
require_once 'sqlconnection.inc.php';
/*
 * Simple Song and Playlist REST API
 * 
 * Available endpoints:
  - List APIs chosen:  
    - Get /artist/id
    - Get /playlist/id
    - Get /user/id
    - Get /song/id  
    - Post /user
    - Get /search
  - Mark secure APIs:  
    - Post /auth/login
    - Post /playlist 
    - Post /song
    - Put /playlist
 */

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
                $songName = getPlaylistByID($playlist_id)[0];
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

if ($resource === 'user') {
    $user_id = isset($id) ? (int)$id : null;

    switch($method) {
        case 'GET':
            if ($user_id) {
                $username = getSongByID($user_id)[0];
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

exit;
?>