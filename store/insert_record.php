<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table'];
    
    switch ($table) {
        case 'product':
            $name = $_POST['name'];
            $serial = $_POST['serial'];
            $model = $_POST['model'];
            $brand = $_POST['brand'];
            $price = $_POST['price'];
            $origin = $_POST['origin'];
            $image = $_POST['image'];
            $category_id = $_POST['category_id'];

            $query = "INSERT INTO product (product_name, serial, model, brand, price, origin, image, category_id) 
                      VALUES ('$name', '$serial', '$model', '$brand', '$price', '$origin', '$image', '$category_id')";
            break;

        case 'product_info':
            $capacity = $_POST['capacity'];
            $dimension = $_POST['dimension'];
            $other_details = $_POST['other_details'];
            $product_id = $_POST['product_id'];

            $query = "INSERT INTO product_info (capacity, dimension, other_details, product_id) 
                      VALUES ('$capacity', '$dimension', '$other_details', '$product_id')";
            break;

        case 'stock':
            $stock = $_POST['stock'];
            $selling_date = $_POST['selling_date'];
            $add_date = $_POST['add_date'];
            $product_id = $_POST['product_id'];

            $query = "INSERT INTO stock (stock, selling_date, add_date, product_id) 
                      VALUES ('$stock', '$selling_date', '$add_date', '$product_id')";
            break;
    }

    if (mysqli_query($con, $query)) {
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<form method="POST" action="insert_record.php">
    <!-- Add input fields based on the table -->
    <input type="hidden" name="table" value="<?php echo $_GET['table']; ?>">
    <!-- Add fields specific to the table (e.g., name, serial for product) -->
    <!-- Submit button -->
    <button type="submit">Submit</button>
</form>
