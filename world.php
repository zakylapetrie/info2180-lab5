<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get the country parameter from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';

// Prepare the SQL query with LIKE for partial matching
// Using prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");

// Add wildcards to the country value for LIKE operator
$searchTerm = "%$country%";
$stmt->execute(['country' => $searchTerm]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>