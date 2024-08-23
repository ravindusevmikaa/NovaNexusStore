<?php
$conn = new mysqli("localhost", "root", "", "order-history");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM order_history";
$result = $conn->query($sql);
$rows = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}
$conn->close();

$json_rows = json_encode($rows);

echo $json_rows;
