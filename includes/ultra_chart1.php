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

// SQL query to get the most recent 10 records for distance1
$sql = "SELECT distance1 FROM ultrasonic ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

$distance1 = [];

// Check if the query was successful
if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Insert data into array
        $distance1[] = $row['distance1'];
    }
} else {
    // Handle query error
    $distance1 = ['Error'];
}

// Close the connection
$conn->close();

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode([
    'distance1' => array_reverse($distance1) // Reverse the array to maintain chronological order
]);
?>
