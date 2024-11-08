<?php
// Database connection parameters
$servername = "localhost";
$username = "admin";
$password = "password";
$database = "DHT22"; // Updated database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get the most recent latitude, longitude, and date record
$sql = "SELECT latitude, longitude, date FROM act6 ORDER BY id DESC LIMIT 1"; // Updated table and columns
$result = $conn->query($sql);

if ($result) {
    if ($row = $result->fetch_assoc()) {
        $latitude = $row['latitude'];   // Fetch latitude value
        $longitude = $row['longitude']; // Fetch longitude value
        $date = $row['date'];           // Fetch date value
    } else {
        $latitude = null;   // Null for better handling in JSON
        $longitude = null;  // Null for better handling in JSON
        $date = null;       // Null for better handling in JSON
    }
} else {
    $latitude = null;   // Null for error handling in JSON
    $longitude = null;  // Null for error handling in JSON
    $date = null;       // Null for error handling in JSON
}

// Close the connection
$conn->close();

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode([
    'latitude' => $latitude,   // Return latitude value
    'longitude' => $longitude, // Return longitude value
    'date' => $date            // Return date value
]);
?>
