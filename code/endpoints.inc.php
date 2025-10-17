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
$resource = $segments[0] ?? ''; //what is being looked up (artist, user, song, playlist)
$id = $segments[1] ?? null; 

$method = $_SERVER['REQUEST_METHOD']; //GET POST PUT DELETE

if ($resource === 'artist') {
    $artist_id = isset($id) ? (int)$id : null;

    switch($method) {
        case 'GET':
            if ($student_id) {
                getArtistByID(1); //test
                //getArtistByID($artist_id);
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
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Resource not found']);
}

?>