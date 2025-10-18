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
  //echo "<br>Connected successfully<br><br>";
} catch (PDOException $e) {
  exit("Connection failed: " . htmlspecialchars($e->getMessage()));
}







#functions --------------------------------------------
/*
function getByID(int $id, string $table, string $idName): array {
  $allowedTables = ['artist', 'song', 'user', 'playlist'];
  global $pdo;

  // Check if the provided table is in the allowlist
  if (!in_array($table, $allowedTables)) {
    throw new InvalidArgumentException("Invalid table name: $table");
  }
  
  try {
    $sql = "SELECT * FROM $table WHERE :idName = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':idName' => $idName
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
*/

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
    $sql = "SELECT * FROM playlist_songs WHERE playlist_id = :id";
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

function createNewUser(string $name): int {
  global $pdo;

  try {
    $sql = "INSERT INTO users (username, user_id) VALUES (:name, :id)";
    $stmt = $pdo->prepare($sql);
    $randomVal = random_int(0, 4294967295);
    $stmt->execute([
      ':name' => $name,
      ':id' => $randomVal
    ]);

    return $randomVal;

  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return null;
  }
}

function getByName(string $searchName): array {
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
