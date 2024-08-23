<?php
include "conn.php";

// Check if product ID is passed via GET
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Query to fetch product details by product ID
    $query = "SELECT * FROM product_info WHERE info_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?></title>
    <link href="../css/header.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            color: #E9E9EB;
            background-color: #0F141C;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .product-details-container {
            background-color: #2c2c2c;
            border: 1px solid #444;
            padding: 20px;
            border-radius: 15px;
            color: #E9E9EB;
            width: 60%;
            max-width: 800px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-details-container img {
            width: 100%;
            max-width: 400px;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .product-details-container h2 {
            margin: 10px 0;
            font-size: 24px;
        }

        .product-details-container p {
            margin: 5px 0;
        }

        .add-to-cart-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .add-to-cart-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="product-details-container">
        <img src="images2/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
        <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
        <p>Model: <?php echo htmlspecialchars($product['model']); ?></p>
        <p>Price: RS<?php echo htmlspecialchars($product['price']); ?>/=</p>
        <button class="add-to-cart-btn">Add to Cart</button>
    </div>
</body>

</html>
