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

// SQL query to get the most recent gas and vibration record
$sql = "SELECT gas, vibration FROM act4 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result) {
    if ($row = $result->fetch_assoc()) {
        $gas = $row['gas'];
        $vibration = $row['vibration'];
    } else {
        $gas = null; // Changed from 'No data' to null for better handling in JSON
        $vibration = null; // Changed from 'No data' to null for better handling in JSON
    }
} else {
    $gas = null; // Changed from 'Error' to null for better handling in JSON
    $vibration = null; // Changed from 'Error' to null for better handling in JSON
}

// Close the connection
$conn->close();

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode([
    'gas' => $gas,
    'vibration' => $vibration
]);
?>
