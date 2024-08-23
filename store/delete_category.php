<?php
include "conn.php";

// Check if the connection is established
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // SQL to delete a record
    $sql = "DELETE FROM category WHERE category_id = ?";

    // Prepare statement
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $category_id);

        // Execute statement
        if ($stmt->execute()) {
            // Redirect back to admin panel after successful deletion
            header("Location: admin_panel.php");
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
    echo "Invalid request: category ID is missing.";
}
?>
