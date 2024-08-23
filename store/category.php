<?php
require 'conn.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle form submission
if (isset($_POST["submit"])) {
    $category_id = $_POST["category_id"];
    $category_name = $_POST["category_name"];

    // Insert data into the category table
    $sql = "INSERT INTO category (category_id, category_name) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("is", $category_id, $category_name);

    if ($stmt->execute()) {
        echo "<script>
                alert('New category inserted successfully');
                window.location.href = 'admin/admin_panel.php';
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
    <title>Category Upload</title>
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
        .form-group input[type="number"],
        .form-group input[type="file"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            color: #333333;
        }

        .form-group select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12l-6-6 1.5-1.5L10 9.5 14.5 4 16 5.5z"/></svg>');
            background-size: 12px;
            background-position: calc(100% - 10px) center;
            background-repeat: no-repeat;
            padding-right: 30px;
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

        .form-group .error-message {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Category Upload Form</h2>
    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="form-group">
            <label for="category_id">Category ID:</label>
            <input type="number" name="category_id" id="category_id" required>
        </div>
        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" id="category_name" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Add Category</button>
        </div>
    </form>
</div>
</body>
</html>
