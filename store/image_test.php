<?php
require 'conn.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch categories for the dropdown list
$result_category = $con->query("SELECT category_id, category_name FROM category");

// Handle form submission
if (isset($_POST["submit"])) {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $serial = $_POST["serial"];
    $model = $_POST["model"];
    $brand = $_POST["brand"];
    $price = $_POST["price"];
    $origin = $_POST["origin"];
    $category_id = $_POST["category_id"];
    
    // Check if image is uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] !== 4) {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if (!in_array($imageExtension, $validImageExtensions)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } else if ($fileSize > 10000000) { // 10MB limit
            echo "<script>alert('Image Size Is Too Large');</script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;

            if (move_uploaded_file($tmpName, 'images2/' . $newImageName)) {
                // Prepare and execute SQL query
                $query = "INSERT INTO product (product_id, product_name, serial, model, brand, price, origin, image, category_id) 
                          VALUES ('$product_id', '$product_name', '$serial', '$model', '$brand', '$price', '$origin', '$newImageName', '$category_id')";

                if (mysqli_query($con, $query)) {
                    echo "<script>
                        alert('Successfully Added');
                        window.location.href = 'admin_panel.php';
                    </script>";
                } else {
                    echo "<script>alert('Failed to insert data: " . mysqli_error($con) . "');</script>";
                }
            } else {
                echo "<script>alert('Failed to move uploaded file');</script>";
            }
        }
    } else {
        echo "<script>alert('No image uploaded');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Upload Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-Pj2oGkBOUGLHgX0kPbkh+rcQe01ylp3RReSnKLWcl1u5NyVr8lXkL94ECv1k3lj8IvIldJN9K1OhwhmU2C5bPA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Product Upload Form</h2>
        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_id">Product ID</label>
                <input type="text" name="product_id" id="product_id" required>
            </div>
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" required>
            </div>
            <div class="form-group">
                <label for="serial">Serial</label>
                <input type="text" name="serial" id="serial" required>
            </div>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" id="model" required>
            </div>
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="origin">Origin</label>
                <input type="text" name="origin" id="origin">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" required>
                    <?php
                    if ($result_category) {
                        if ($result_category->num_rows > 0) {
                            while ($row = $result_category->fetch_assoc()) {
                                echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                            }
                        } else {
                            echo "<option value=''>No categories found</option>";
                        }
                    } else {
                        echo "<option value=''>Error fetching categories</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
        
    </div>
</body>
</html>
