<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #191919;
            padding: 0;
            margin: 0;
            color: #fff;
            display: flex;
            height: 100vh;
            /* Ensures body takes full  */
        }

        .navbar {
            width: 20%;
            background-color: #333;
            padding: 10px;
            height: 100%;
            /* Takes full height of the viewport */
            box-sizing: border-box;
            overflow-y: auto;
            /* Enables vertical scrolling */
        }

        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .content {
            width: 80%;
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto;
            /* Enables vertical scrolling if content overflows */
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        .table1,
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #181818;
            /* Updated header background color */
            color: #fff;
            /* Updated header text color */
        }

        .btn,
        .action-btn,
        .delete-btn {
            padding: 10px;
            color: #fff;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            border-radius: 4px;
            background-color: #090909;
            /* Updated button background color */
        }

        .btn:hover,
        .action-btn:hover,
        .delete-btn:hover {
            background-color: #030303;
            /* Updated button hover color */
        }

        img {
            max-width: 100px;
            height: auto;
            border-radius: 4px;
        }

        .scrollable-table {
            overflow-x: auto;
        }
    </style>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');
        }
    </script>
</head>

<body>
    <div class="navbar">
        <a href="#" onclick="showSection('categories')">Categories</a>
        <a href="#" onclick="showSection('products')">Products</a>
        <a href="#" onclick="showSection('product-info')">Product Information</a>
    </div>
    <div class="content">
        <!-- Categories Section -->
        <div id="categories" class="section active">
            <h2>Categories</h2>
            <h4>Add a new category <button class="btn" onclick="window.location.href='category.php'">Add New</button></h4>
            <div class="scrollable-table">
                <table class="table1">
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    include "conn.php";
                    $sql_category = "SELECT * FROM category";
                    $result_category = $con->query($sql_category);
                    if ($result_category) {
                        if ($result_category->num_rows > 0) {
                            while ($row = $result_category->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($row["category_id"]) . "</td>
                                        <td>" . htmlspecialchars($row["category_name"]) . "</td>
                                        <td>
                                            <a href='update_category.php?id=" . htmlspecialchars($row["category_id"]) . "' class='action-btn'>Update</a>
                                            <a href='admin_panel.php?delete_category=" . htmlspecialchars($row["category_id"]) . "' class='delete-btn'>Delete</a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No categories found</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Query error: " . htmlspecialchars($con->error) . "</td></tr>";
                    }
                    $con->close();
                    ?>
                </table>
            </div>
        </div>

        <!-- Products Section -->
        <div id="products" class="section">
            <h2>Products</h2>
            <h4>Add a new product <button class="btn" onclick="window.location.href='image_test.php'">Add New</button></h4>
            <div class="scrollable-table">
                <table class="table1">
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Serial</th>
                        <th>Model</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Origin</th>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    include "conn.php";
                    $sql_product = "SELECT p.product_id, p.product_name, p.serial, p.model, p.brand, p.price, p.origin, p.image, c.category_name 
                                    FROM product p 
                                    JOIN category c ON p.category_id = c.category_id";
                    $result_product = $con->query($sql_product);
                    if ($result_product) {
                        if ($result_product->num_rows > 0) {
                            while ($row = $result_product->fetch_assoc()) {
                                $imagePath = 'images2/' . htmlspecialchars($row["image"]);
                                echo "<tr>
                                        <td>" . htmlspecialchars($row["product_id"]) . "</td>
                                        <td>" . htmlspecialchars($row["product_name"]) . "</td>
                                        <td>" . htmlspecialchars($row["serial"]) . "</td>
                                        <td>" . htmlspecialchars($row["model"]) . "</td>
                                        <td>" . htmlspecialchars($row["brand"]) . "</td>
                                        <td>" . htmlspecialchars($row["price"]) . "</td>
                                        <td>" . htmlspecialchars($row["origin"]) . "</td>
                                        <td>" . htmlspecialchars($row["category_name"]) . "</td>
                                        <td><img src='" . $imagePath . "' alt='Product Image'></td>
                                        <td>
                                            <a href='update_product.php?id=" . htmlspecialchars($row["product_id"]) . "' class='action-btn'>Update</a>
                                            <a href='admin_panel.php?delete_product=" . htmlspecialchars($row["product_id"]) . "' class='delete-btn'>Delete</a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No products found</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>Query error: " . htmlspecialchars($con->error) . "</td></tr>";
                    }
                    $con->close();
                    ?>
                </table>
            </div>
        </div>

        <!-- Product Information Section -->
        <div id="product-info" class="section">
            <h2>Product Information</h2>
            <h4>Add new product information <button class="btn" onclick="window.location.href='product_info.php'">Add New</button></h4>
            <div class="scrollable-table">
                <table class="info-table">
                    <thead>
                        <tr>
                            <th>Info ID</th>
                            <th>Product Name</th>
                            <th>Capacity</th>
                            <th>Dimension</th>
                            <th>Other Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "conn.php";
                        $sql_product_info = "SELECT pi.info_id, pi.capacity, pi.dimension, pi.other_details, p.product_name 
                                             FROM product_info pi
                                             JOIN product p ON pi.product_id = p.product_id";
                        $result_product_info = $con->query($sql_product_info);
                        if ($result_product_info) {
                            if ($result_product_info->num_rows > 0) {
                                while ($row = $result_product_info->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . htmlspecialchars($row['info_id']) . "</td>
                                            <td>" . htmlspecialchars($row['product_name']) . "</td>
                                            <td>" . htmlspecialchars($row['capacity']) . "</td>
                                            <td>" . htmlspecialchars($row['dimension']) . "</td>
                                            <td>" . htmlspecialchars($row['other_details']) . "</td>
                                            <td>
                                                <a href='update_pro_info.php?id=" . htmlspecialchars($row['info_id']) . "' class='action-btn'>Update</a>
                                                <a href='admin_panel.php?delete_product_info=" . htmlspecialchars($row['info_id']) . "' class='delete-btn'>Delete</a>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No product information found</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Query error: " . htmlspecialchars($con->error) . "</td></tr>";
                        }
                        $con->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>