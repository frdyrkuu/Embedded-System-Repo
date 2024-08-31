<?php
// Database connection parameters
$servername = "localhost";
$username = "admin";
$password = "password";
$database = "DHT22";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get the most recent 10 records
$sql = "SELECT temperature, humidity FROM dht22_values ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

$temperature = [];
$humidity = [];

// Check if the query was successful
if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Insert data into arrays
        $temperature[] = $row['temperature'];
        $humidity[] = $row['humidity'];
    }
} else {
    // Handle query error
    $temperature = ['Error'];
    $humidity = ['Error'];
}

// Close the connection
$conn->close();

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode([
    'temperature' => array_reverse($temperature),
    'humidity' => array_reverse($humidity)
]);
?>
