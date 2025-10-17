<?php
declare(strict_types=1);

// --- Database connection (PDO) ---
$servername = "localhost";
$username = "root";
$password = "mySQL@pass123";
$dbname = "testingdb";

try {
  $dsn = "mysql:host={$servername};dbname={$dbname};charset=utf8mb4";
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // throw exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,                  // use native prepares
  ];
  $pdo = new PDO($dsn, $username, $password, $options);
  echo "Connected successfully<br><br>";
} catch (PDOException $e) {
  exit("Connection failed: " . htmlspecialchars($e->getMessage()));
}







#functions --------------------------------------------

function getByID(int $id, string $table): array {
  echo "<h2>GET - getting row from table from DB</h2>";

  try {
    $sql = "SELECT * FROM $table WHERE {$table}_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':id' => $id,
    ]);

    #check if successful
    $row = $stmt->fetch();

    if ($row) {
      echo "Successful getting by ID from $table <br>";
      return $row;
    } 
    else {
      echo "No student found with ID {$student_id}<br>";
    }
  } catch (PDOExeption $e) {
    echo "Error (CREATE): " . htmlspecialchars($e->getMessage()) . "<br><br>";
  }
}

function getArtistByID(int $id): void {
  echo "<h2>GET - getting artist from DB</h2>";

  $row = getByID($pdo, $id, 'artist');
  echo "Got {$row['Name']} <br>";
}



#no auth
#get from db method
#post user

#auth needed
#post login
#post to db (playlist and song)
#put to db (playlist)
?>
