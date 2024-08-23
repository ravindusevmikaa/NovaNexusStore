<?php
require 'conn.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch existing data if info_id is provided
$info_id = isset($_GET['id']) ? $_GET['id'] : null;
$info_details = null;

if ($info_id) {
    $sql = "SELECT * FROM product_info WHERE info_id = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $info_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $info_details = $result->fetch_assoc();
        } else {
            echo "<script>alert('No product information found with ID $info_id'); window.location.href = 'admin_panel.php';</script>";
            exit;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement'); window.location.href = 'admin_panel.php';</script>";
        exit;
    }
}

// Fetch products for dropdown
$product_query = $con->query("SELECT product_id, product_name FROM product");
$products = [];
if ($product_query) {
    while ($row = $product_query->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "<script>alert('Error fetching products');</script>";
}

// Handle form submission
if (isset($_POST["submit"])) {
    $info_id = $_POST["info_id"];
    $capacity = $_POST["capacity"];
    $dimension = $_POST["dimension"];
    $other_details = $_POST["other_details"];
    $product_id = $_POST["product_id"];

    $sql = "UPDATE product_info SET capacity=?, dimension=?, other_details=?, product_id=? WHERE info_id=?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("sssii", $capacity, $dimension, $other_details, $product_id, $info_id);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Product information updated successfully');
                    window.location.href = 'admin_panel.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error updating product information: " . $stmt->error . "');
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement');</script>";
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product Information</title>
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
        .form-group textarea,
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
    </style>
</head>
<body>
<div class="form-container">
    <h2>Update Product Information</h2>
    <form action="" method="post" autocomplete="off">
        <div class="form-group">
            <label for="info_id">Info ID:</label>
            <input type="text" name="info_id" id="info_id" value="<?php echo htmlspecialchars($info_details['info_id'] ?? ''); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <input type="text" name="capacity" id="capacity" value="<?php echo htmlspecialchars($info_details['capacity'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="dimension">Dimension:</label>
            <input type="text" name="dimension" id="dimension" value="<?php echo htmlspecialchars($info_details['dimension'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="other_details">Other Details:</label>
            <textarea name="other_details" id="other_details" rows="4" required><?php echo htmlspecialchars($info_details['other_details'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="product_id">Product:</label>
            <select name="product_id" id="product_id" required>
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo htmlspecialchars($product['product_id']); ?>" <?php echo ($info_details['product_id'] ?? '') == $product['product_id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($product['product_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Update Product</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='admin_panel.php'">Cancel</button>
        </div>
    </form>
</div>
</body>
</html>
