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

// SQL query to get the most recent record, including distance1
$sql = "SELECT distance, distance1 FROM ultrasonic ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result) {
    if ($row = $result->fetch_assoc()) {
        $distance = $row['distance'];
        $distance1 = $row['distance1'];
    } else {
        $distance = 'No data';
        $distance1 = 'No data';
    }
} else {
    $distance = 'Error';
    $distance1 = 'Error';
}

// Close the connection
$conn->close();

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode([
    'distance' => $distance,
    'distance1' => $distance1
]);
?>
