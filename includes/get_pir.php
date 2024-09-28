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

// SQL query to get the most recent PIR movement record
$sql = "SELECT movement FROM pir_motion ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result) {
    if ($row = $result->fetch_assoc()) {
        $movement = $row['movement'];
    } else {
        $movement = 'No data';
    }
} else {
    $movement = 'Error';
}

// Close the connection
$conn->close();

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode([
    'pir' => $movement
]);
?>
