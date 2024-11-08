<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";
$username = "admin";
$password = "password";
$database = "DHT22";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit; // Stop execution on error
}

// SQL query to get the 10 most recent sound and rain records
$sql = "SELECT sound, rain FROM act5 ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

$soundData = [];
$rainData = [];

// Maximum value for the sound sensor (replace with your actual max value)
$maxSoundValue = 1023;

if ($result) {
    // Fetch all rows and store sound and rain data
    while ($row = $result->fetch_assoc()) {
        // Convert sound to percentage
        $soundPercentage = ($row['sound'] / $maxSoundValue) * 100;
        $soundData[] = round($soundPercentage, 2); // Round to 2 decimal places
        $rainData[] = $row['rain'];
    }
} else {
    echo json_encode(['error' => 'SQL Error: ' . $conn->error]);
    exit; // Stop execution on error
}

// Close the connection
$conn->close();

// Output JSON response with arrays of the latest 10 records
echo json_encode([
    'sound' => array_reverse($soundData), // Reverse to show latest first
    'rain' => array_reverse($rainData) // Reverse to show latest first
]);
