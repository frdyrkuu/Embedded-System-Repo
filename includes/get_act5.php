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

// SQL query to get the most recent sound and rain record
$sql = "SELECT sound, rain FROM act5 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result) {
    if ($row = $result->fetch_assoc()) {
        $sound = $row['sound']; // Fetch sound value
        $rain = $row['rain'];   // Fetch rain value
    } else {
        $sound = null; // Changed from 'No data' to null for better handling in JSON
        $rain = null;  // Changed from 'No data' to null for better handling in JSON
    }
} else {
    $sound = null; // Changed from 'Error' to null for better handling in JSON
    $rain = null;  // Changed from 'Error' to null for better handling in JSON
}

// Close the connection
$conn->close();

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode([
    'sound' => $sound, // Return sound value
    'rain' => $rain    // Return rain value
]);
