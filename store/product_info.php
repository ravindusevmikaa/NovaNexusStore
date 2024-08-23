<?php
require 'conn.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch product names and IDs for dropdown
$product_query = $con->query("SELECT product_id, product_name FROM product");
$products = [];
if ($product_query) {
    while ($row = $product_query->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "Error fetching products: " . $con->error;
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $info_id = $_POST["info_id"];
    $capacity = $_POST["capacity"];
    $dimension = $_POST["dimension"];
    $other_details = $_POST["other_details"];
    $product_id = $_POST["product_id"];

    // Insert new record
    $query = $con->prepare("INSERT INTO product_info (info_id, capacity, dimension, other_details, product_id) VALUES (?, ?, ?, ?, ?)");
    if (!$query) {
        echo "Prepare failed: (" . $con->errno . ") " . $con->error;
        exit();
    }
    $bind = $query->bind_param('isssi', $info_id, $capacity, $dimension, $other_details, $product_id);
    if (!$bind) {
        echo "Binding parameters failed: (" . $query->errno . ") " . $query->error;
        exit();
    }
    $exec = $query->execute();
    if ($exec) {
        echo "<script>alert('Information successfully saved');</script>";
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "<script>alert('Failed to save information: " . $query->error . "');</script>";
    }
}

// Fetch all product info for display
$product_info_query = $con->query("SELECT pi.info_id, pi.capacity, pi.dimension, pi.other_details, p.product_name 
                                   FROM product_info pi
                                   JOIN product p ON pi.product_id = p.product_id");
$product_info = [];
if ($product_info_query) {
    while ($row = $product_info_query->fetch_assoc()) {
        $product_info[] = $row;
    }
} else {
    echo "Error fetching product info: " . $con->error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information Form</title>
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
            max-width: 600px;
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
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .info-table th, .info-table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .info-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Product Information Form</h2>
        <form action="" method="post" autocomplete="off">
            <div class="form-group">
                <label for="info_id">Info ID</label>
                <input type="text" name="info_id" id="info_id" required>
            </div>
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="text" name="capacity" id="capacity" required>
            </div>
            <div class="form-group">
                <label for="dimension">Dimension</label>
                <input type="text" name="dimension" id="dimension" required>
            </div>
            <div class="form-group">
                <label for="other_details">Other Details</label>
                <textarea name="other_details" id="other_details" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="product_id">Product</label>
                <select name="product_id" id="product_id" required>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo htmlspecialchars($product['product_id']); ?>">
                            <?php echo htmlspecialchars($product['product_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
