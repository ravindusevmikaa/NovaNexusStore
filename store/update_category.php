<?php
require 'conn.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if category ID is provided
$category_id = isset($_GET['id']) ? $_GET['id'] : null;
$category_details = null;

if ($category_id) {
    $sql = "SELECT * FROM category WHERE category_id = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $category_details = $result->fetch_assoc();
        } else {
            echo "<script>alert('No category found with ID $category_id'); window.location.href = 'admin_panel.php';</script>";
            exit;
        }
        $stmt->close();
    }
}

// Handle form submission
if (isset($_POST["submit"])) {
    $category_id = $_POST["category_id"];
    $category_name = $_POST["category_name"];

    // Update data in the category table
    $sql = "UPDATE category SET category_name=? WHERE category_id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $category_name, $category_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Category updated successfully');
                window.location.href = 'admin_panel.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $stmt->error . "');
              </script>";
    }

    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Pj2oGkBOUGLHgX0kPbkh+rcQe01ylp3RReSnKLWcl1u5NyVr8lXkL94ECv1k3lj8IvIldJN9K1OhwhmU2C5bPA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            max-width: 700px;
            width: 100%;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333333;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            color: #333333;
        }

        .form-group button[type="submit"] {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .form-group button[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-group .cancel-btn {
            background-color: #f44336;
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-left: 10px;
        }

        .form-group .cancel-btn:hover {
            background-color: #e53935;
        }

        .form-group .error-message {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Update Category Form</h2>
    <form action="" method="post" autocomplete="off">
        <div class="form-group">
            <label for="category_id">Category ID:</label>
            <input type="number" name="category_id" id="category_id" value="<?php echo htmlspecialchars($category_details['category_id'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" id="category_name" value="<?php echo htmlspecialchars($category_details['category_name'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Update Category</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='admin_panel.php'">Cancel</button>
        </div>
    </form>
</div>
</body>
</html>
