<?php
// Include database connection
include 'db_connection.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details
    $product_query = "SELECT * FROM product WHERE product_id = $product_id";
    $product_result = mysqli_query($conn, $product_query);
    $product = mysqli_fetch_assoc($product_result);

    // Fetch product_info details
    $info_query = "SELECT * FROM product_info WHERE product_id = $product_id";
    $info_result = mysqli_query($conn, $info_query);
    $product_info = mysqli_fetch_assoc($info_result);

    // Fetch stock details
    $stock_query = "SELECT * FROM stock WHERE product_id = $product_id";
    $stock_result = mysqli_query($conn, $stock_query);
    $stock = mysqli_fetch_assoc($stock_result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['product_name']; ?> - Details</title>
    <style>
        .product-details {
            display: flex;
        }
        .product-image {
            width: 30%;
            height: auto;
        }
        .product-info {
            width: 70%;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="product-details">
        <div class="product-image">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['product_name']; ?>" style="width: 100%; height: auto;">
        </div>
        <div class="product-info">
            <h1><?php echo $product['product_name']; ?></h1>
            <p><strong>Serial:</strong> <?php echo $product['serial']; ?></p>
            <p><strong>Model:</strong> <?php echo $product['model']; ?></p>
            <p><strong>Brand:</strong> <?php echo $product['brand']; ?></p>
            <p><strong>Price:</strong> $<?php echo $product['price']; ?></p>
            <p><strong>Origin:</strong> <?php echo $product['origin']; ?></p>
            <p><strong>Capacity:</strong> <?php echo $product_info['capacity']; ?></p>
            <p><strong>Dimension:</strong> <?php echo $product_info['dimension']; ?></p>
            <p><strong>Other Details:</strong> <?php echo $product_info['other_details']; ?></p>
            <p><strong>Stock:</strong> <?php echo $stock['stock']; ?></p>
            <p><strong>Selling Date:</strong> <?php echo $stock['selling_date']; ?></p>
            <p><strong>Added Date:</strong> <?php echo $stock['add_date']; ?></p>
        </div>
    </div>
</body>
</html>
