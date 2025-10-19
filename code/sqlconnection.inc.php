<?php
declare(strict_types=1);

// --- Database connection (PDO) ---
$servername = "localhost";
$username = "root";
$password = "mySQL@pass123";
$dbname = "testingdb";

try {
  $dsn = "mysql:host={$servername};dbname={$dbname};charset=utf8mb4";
  $options =[];
  $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
  exit("Connection failed: " . htmlspecialchars($e->getMessage()));
}



function getArtistByID(int $id): array {
  global $pdo;
  try {
    $sql = "SELECT * FROM artist WHERE artist_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id,
    ]);

    #check if successful
    $row = $stmt->fetch();

    if ($row) {
      return $row;
    } 
    else {
      return ['error no row found'];
    }
  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return ['error PDO exeption'];
  }
}

function getPlaylistByID(int $id): array {
  global $pdo;
  try {
    $sql = "SELECT * FROM playlist WHERE playlist_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id,
    ]);

    #check if successful
    $rows = $stmt->fetchAll();

    if ($rows) {
      return $rows;
    } 
    else {
      return ['error no row found'];
    }
  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return ['error PDO exeption'];
  }
}

function getUserByID(int $id): array {
  global $pdo;
  try {
    $sql = "SELECT * FROM users WHERE user_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id,
    ]);


    #check if successful
    $row = $stmt->fetch();

    if ($row) {
      return $row;
    } 
    else {
      return ['error no row found'];
    }
  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return [$e->getMessage()];
  }
}

function getSongByID(int $id): array {
  global $pdo;
  try {
    $sql = "SELECT * FROM songs WHERE song_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id,
    ]);

    #check if successful
    $row = $stmt->fetch();

    if ($row) {
      return $row;
    } 
    else {
      return ['error no row found'];
    }
  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return ['error PDO exeption'];
  }
}

function createNewUser(string $name, string $password): int {
  global $pdo;

  try {
    $sql = "INSERT INTO users (username, user_id, password) VALUES (:name, :id, :password)";
    $stmt = $pdo->prepare($sql);
    $randomVal = random_int(0, 4294967295);
    $stmt->execute([
      ':name' => $name,
      ':id' => $randomVal,
      ':password' => $password
    ]);

    return $randomVal;

  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return -1;
  }
}

function getSongByName(string $searchName): array {
  global $pdo;
  try {
    $sql = "SELECT * FROM songs WHERE name = :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':search' => $searchName
    ]);

    #check if successful
    $rows = $stmt->fetchAll();

    if ($rows) {
      return $rows;
    } 
    else {
      return ['error no row found'];
    }
  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return ['error PDO exception'];
  }
}

function getArtistByName(string $searchName): array {
  global $pdo;
  try {
    $sql = "SELECT * FROM artist WHERE name = :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':search' => $searchName
    ]);

    #check if successful
    $rows = $stmt->fetch();

    if ($rows) {
      return $rows;
    } 
    else {
      return ['error no row found'];
    }
  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return ['error PDO exception'];
  }
}

function checkCredentials(string $username,string $password): bool {
  global $pdo;
  //is user and pass set

  try {
    $sql = "SELECT * FROM users WHERE username = :username AND password = :pass";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':username' => $username,
      ':pass' => $password
    ]);

    #check if successful
    $row = $stmt->fetch();

    if ($row) {
      return true;
    } 
    else {
      return false;
    }
  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return false;
    //return ['error PDO exception'];
  }

}

function createNewSong(string $name, string $artistName, int $songLength): int {
  global $pdo;
  $artistID = getArtistByName($artistName)['Artist_ID'];

  try {
    $sql = "INSERT INTO songs (song_id, artist_ID, name, length_in_sec) VALUES (:songID, :artistID, :name, :songLength)";
    $stmt = $pdo->prepare($sql);
    $randomVal = random_int(0, 4294967295);
    $stmt->execute([
      ':songID' => $randomVal,
      ':artistID' => $artistID,
      ':name' => $name,
      'songLength' => $songLength
    ]);

    return $randomVal;

  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return -1;
  }
}

function createNewPlaylist(string $userID): int {
  global $pdo;

  try {
    $sql = "INSERT INTO playlist (Playlist_ID, User_ID) VALUES (:playlistID, :userID)";
    $stmt = $pdo->prepare($sql);
    $randomVal = random_int(0, 4294967295);
    $stmt->execute([
      ':playlistID' => $randomVal,
      ':userID' => $userID
    ]);

    return $randomVal;

  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return -1;
  }
}

function addSongToPlaylist(int $playlistID, int $songID): string {
  global $pdo;

  try {
    $sql = "INSERT INTO playlist_songs (Playlist_ID, Song_ID) VALUES (:playlistID, :songID)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':playlistID' => $playlistID,
      ':songID' => $songID
    ]);

    return "Added song by the ID $songID to the playlist with the ID $playlistID";

  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return 'Failed to add song';
  }
}
/*
 * Simple Song and Playlist REST API
 * 
 * Available endpoints:
  - List APIs chosen:  
    - //Get /artist/id
    - //Get /playlist/id
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

#no auth
#get from db method
#post user

#auth needed
#post login
#post to db (playlist and song)
#put to db (playlist)
?>
