<?php
include "conn.php";

if (isset($_GET['category_name'])) {
    $category_name = $_GET['category_name'];

    if ($category_name === 'All') {
        // Query to fetch all products
        $query = "SELECT product_name, model, price, image FROM product";
    } else {
        // Query to fetch products based on the category name
        $query = "SELECT p.product_name, p.model, p.price, p.image
                  FROM product p
                  JOIN category c ON p.category_id = c.category_id
                  WHERE c.category_name = ?";
    }
    
    if ($stmt = $con->prepare($query)) {
        if ($category_name !== 'All') {
            $stmt->bind_param("s", $category_name);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        $products = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        $stmt->close();
        
        echo json_encode($products);
    } else {
        echo json_encode(array("error" => "Failed to prepare statement"));
    }
} else {
    echo json_encode(array("error" => "Category name not provided"));
}

$con->close();
?>
