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
$sql = "SELECT distance FROM ultrasonic ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

$distance = [];

// Check if the query was successful
if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Insert data into array
        $distance[] = $row['distance'];
    }
} else {
    // Handle query error
    $distance = ['Error'];
}

// Close the connection
$conn->close();

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode([
    'distance' => array_reverse($distance) // Reverse the array to maintain chronological order
]);
?>
