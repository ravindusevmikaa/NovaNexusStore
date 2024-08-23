<?php
include "conn.php";

// Check if the connection is established
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_GET['id'])) {
    $pro_info_id = $_GET['id'];
    $deleteConfirmed = isset($_GET['confirm']) && $_GET['confirm'] == "yes";

    if ($deleteConfirmed) {
        $sql = "DELETE FROM product_info WHERE info_id = ?";

        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("i", $pro_info_id);

            // Execute statement
            try {
                if ($stmt->execute()) {
                    echo "<script>alert('Record deleted successfully!'); window.location.href = 'admin_panel.php';</script>";
                } else {
                    // Display the SQL error message in an alert box
                    echo "<script>alert('Error deleting record: " . addslashes($stmt->error) . "'); window.location.href = 'admin_panel.php';</script>";
                }
            } catch (Exception $e) {
                // Catch any other exceptions and display the error message
                echo "<script>alert('Exception occurred: " . addslashes($e->getMessage()) . "'); window.location.href = 'admin_panel.php';</script>";
            }

            // Close statement
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing statement: " . addslashes($con->error) . "'); window.location.href = 'admin_panel.php';</script>";
        }

        // Close connection
        $con->close();
    } else {
        echo "<script>
            if (confirm('Are you sure you want to delete this record?')) {
                window.location.href = 'delete_pro_info.php?id=$pro_info_id&confirm=yes';
            } else {
                window.location.href = 'admin_panel.php';
            }
        </script>";
    }
} else {
    echo "<script>alert('Invalid request: product info ID is missing.'); window.location.href='admin_panel.php';</script>";
}
?>
