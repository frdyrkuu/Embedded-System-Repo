<?php
// Database connection
$servername = "localhost";
$username = "admin"; // Replace with your database username
$password = "password"; // Replace with your database password
$dbname = "DHT22"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest command status
$sql = "SELECT command_status FROM act7 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
    echo json_encode($row); // Return as JSON
} else {
    echo json_encode(['command_status' => 'N/A']);
}

$conn->close();
?>
