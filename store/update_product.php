<?php
require 'conn.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if part ID is provided
$part_id = isset($_GET['id']) ? $_GET['id'] : null;
$part_details = null;

if ($part_id) {
    $sql = "SELECT * FROM product WHERE product_id = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $part_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $part_details = $result->fetch_assoc();
        }
        $stmt->close();
    }
}

// Handle form submission
if (isset($_POST["submit"])) {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $serial = $_POST["serial"];
    $model = $_POST["model"];
    $brand = $_POST["brand"];
    $price = $_POST["price"];
    $origin = $_POST["origin"];
    $image = $part_details['image']; // Default to current image
    $category_id = $_POST["category_id"];

    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $validImageExtensions)) {
            echo "<script>alert('Invalid Image Extension');</script>";
        } else if ($fileSize > 10000000) { // Updated the file size limit to 10MB
            echo "<script>alert('Image Size Is Too Large');</script>";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            move_uploaded_file($tmpName, 'images2/' . $newImageName);
            $image = $newImageName; // Update image name if new file is uploaded
        }
    }

    $query = "UPDATE product SET product_name=?, serial=?, model=?, brand=?, price=?, origin=?, image=?, category_id=? WHERE product_id=?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("ssssssssi", $product_name, $serial, $model, $brand, $price, $origin, $image, $category_id, $product_id);
        if ($stmt->execute()) {
            echo "<script>
                alert('Successfully Updated');
                window.location.href = 'admin_panel.php';
            </script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Part</title>
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
    <h2>Update Product Form</h2>
    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($part_details['product_id']); ?>">

        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" id="product_name" value="<?php echo htmlspecialchars($part_details['product_name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="serial">Serial:</label>
            <input type="text" name="serial" id="serial" value="<?php echo htmlspecialchars($part_details['serial']); ?>" required>
        </div>

        <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" name="model" id="model" value="<?php echo htmlspecialchars($part_details['model']); ?>" required>
        </div>

        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" name="brand" id="brand" value="<?php echo htmlspecialchars($part_details['brand']); ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" step="0.01" value="<?php echo htmlspecialchars($part_details['price']); ?>" required>
        </div>

        <div class="form-group">
            <label for="origin">Origin:</label>
            <input type="text" name="origin" id="origin" value="<?php echo htmlspecialchars($part_details['origin']); ?>" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category ID:</label>
            <input type="number" name="category_id" id="category_id" value="<?php echo htmlspecialchars($part_details['category_id']); ?>" required>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
            <?php if ($part_details['image']) { ?>
                <p>Current Image: <img src="images2/<?php echo htmlspecialchars($part_details['image']); ?>" alt="Current Image" style="max-width: 150px; height: auto;"></p>
            <?php } ?>
        </div>

        <div class="form-group">
            <button type="submit" name="submit">Update</button>
        </div>
    </form>
</div>
</body>
</html>
