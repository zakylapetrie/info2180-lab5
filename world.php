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
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Continent</th>
            <th>Independence</th>
            <th>Head of State</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['continent']); ?></td>
            <td><?= htmlspecialchars($row['independence_year']); ?></td>
            <td><?= htmlspecialchars($row['head_of_state']); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>