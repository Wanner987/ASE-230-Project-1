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

function getByID(int $id, string $table): array {
  $allowedTables = ['artist', 'song', 'user', 'playlist'];
  global $pdo;

  // Check if the provided table is in the allowlist
  if (!in_array($table, $allowedTables)) {
    throw new InvalidArgumentException("Invalid table name: $table");
  }
  
  try {
    $sql = "SELECT * FROM $table WHERE {$table}_id = :id";
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
      return ['error'];
    }
  } catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    return ['error'];
  }
}

function getArtistByID(int $id): array {
  $row = getByID($id, 'artist');
  return $row;
}


#no auth
#get from db method
#post user

#auth needed
#post login
#post to db (playlist and song)
#put to db (playlist)
?>
