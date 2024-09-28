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
    // Output error as JSON
    echo json_encode([
        'error' => 'Connection failed: ' . $conn->connect_error
    ]);
    exit; // Stop execution on error
}

// SQL query to get the 10 most recent gas and vibration records
$sql = "SELECT gas, vibration FROM act4 ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

$gasData = [];
$vibrationData = [];

if ($result) {
    // Fetch all rows and store gas and vibration data
    while ($row = $result->fetch_assoc()) {
        $gasData[] = $row['gas'];
        $vibrationData[] = $row['vibration'];
    }
} else {
    // Handle SQL error
    echo json_encode([
        'error' => 'SQL Error: ' . $conn->error
    ]);
    exit; // Stop execution on error
}

// Close the connection
$conn->close();

// Set content type to JSON
header('Content-Type: application/json');

// Output JSON response with arrays of the latest 10 records
echo json_encode([
    'gas' => array_reverse($gasData), // Reverse to show latest first
    'vibration' => array_reverse($vibrationData) // Reverse to show latest first
]);
?>
