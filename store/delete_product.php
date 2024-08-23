<?php
include "conn.php";

if (isset($_GET['id'])) {
    $part_id = $_GET['id'];

    // SQL to delete a record
    $sql = "DELETE FROM parts_info WHERE part_id = ?";

    // Prepare statement
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $part_id);

        // Execute statement
        if ($stmt->execute()) {
            // Redirect back to admin panel after successful deletion
            header("Location: admin_penal.php");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }

    // Close connection
    $con->close();
} else {
    echo "Invalid request.";
}
?>
