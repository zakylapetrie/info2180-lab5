<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get the country parameter from the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

// Check if we should lookup cities or countries
if ($lookup === 'cities') {
    // Query to get cities for the specified country
    // SQL JOIN between cities and countries tables
    $stmt = $conn->prepare("
        SELECT cities.name, cities.district, cities.population 
        FROM cities 
        JOIN countries ON cities.country_code = countries.code 
        WHERE countries.name LIKE :country
        ORDER BY cities.population DESC
    ");
    
    $searchTerm = "%$country%";
    $stmt->execute(['country' => $searchTerm]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>District</th>
                <th>Population</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($results) > 0): ?>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['district']); ?></td>
                    <td><?= number_format($row['population']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No cities found for the specified country.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php
} else {
    // Query to get country information
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    
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
        <?php if (count($results) > 0): ?>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['continent']); ?></td>
                    <td><?= htmlspecialchars($row['independence_year']); ?></td>
                    <td><?= htmlspecialchars($row['head_of_state']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No countries found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php
}
?>