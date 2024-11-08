<?php
// Database connection
$servername = "localhost";
$username = "admin";
$password = "password";
$dbname = "DHT22";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest sensor data (temperature, humidity, rain, and sound)
$sql = "SELECT rain, sound, humidity, temperature FROM act5 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data as JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    // Default data in case of no records
    echo json_encode([
        "rain" => 0,
        "sound" => 0,
        "humidity" => 0,
        "temperature" => 0
    ]);
}

$conn->close();
?>
