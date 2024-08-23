<?php
require 'conn.php';

header('Content-Type: application/json');

$part_name = isset($_GET['part_name']) ? $_GET['part_name'] : '';

if ($part_name) {
    $stmt = $con->prepare("SELECT * FROM parts_info WHERE part_name = ? ORDER BY part_id DESC");
    $stmt->bind_param("s", $part_name);
} else {
    $stmt = $con->prepare("SELECT * FROM parts_info ORDER BY part_id DESC");
}

$stmt->execute();
$result = $stmt->get_result();

$parts = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $parts[] = $row;
    }
}

echo json_encode($parts);
?>
