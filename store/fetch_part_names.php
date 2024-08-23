<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_nsbm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch distinct part names
$sql = "SELECT DISTINCT part_name FROM parts_info";
$result = $conn->query($sql);

$partNames = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $partNames[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($partNames);
?>
