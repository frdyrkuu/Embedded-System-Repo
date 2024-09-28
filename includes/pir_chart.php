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
$sql = "SELECT movement FROM pir_motion ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

$movement = [];

// Check if the query was successful
if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Insert data into array
        $movement[] = $row['movement'];
    }
} else {
    // Handle query error
    $movement = ['Error'];
}

// Close the connection
$conn->close();

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode([
    'movement' => array_reverse($movement) // Reverse the array to maintain chronological order
]);
?>
