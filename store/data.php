<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="data12.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .part-box {
            position: relative;
            margin-bottom: 20px;
            /* border: 1px solid #000; */
            padding: 5px;
            width: 250px;
            color: #fff;
            
        }
    
        .icon-box {
            position: absolute;
            top: 5px;
            right: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            background: rgba(255, 255, 255, 0.8);
            background: #161616;
            color: #fff;
            visibility: hidden;
        }
        .part-box:hover .icon-box {
            visibility: visible;
        }
        .icon-box i {
            cursor: pointer;
        }
        .part-details {
            padding: 10px 0;
        }
        .part-details p {
            margin: 5px 0;
        }
        .rating {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 5px;
        }
        .rating i {
            color: #FFD700;
        }
        .popup-content {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: 600px;
            height: 400px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        #popupImage {
            flex: 1;
            max-width: 50%;
            max-height: 100%;
            transition: transform 0.3s ease;
        }
        #popupImage:hover {
            transform: scale(1.3);
        }
        #popupDetails {
            flex: 2;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .popup-content button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .popup-content button:hover {
            background-color: #111;
        }
        .popup-content button i {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="nav-bar">
        <ul>
            <li onclick="filtercategory('all')">All</li>
            <li onclick="filtercategory('Monitor')">Monitor</li>
            <li onclick="filtercategory('Keyboard')">Keyboard</li>
            <li onclick="filtercategory('Mouse')">Mouse</li>
            <li onclick="filtercategory('RAM')">RAM</li>
            <li onclick="filtercategory('ROM')">ROM</li>
        </ul>
    </div>

    <div class="category-container" id="categoryContainer">
    </div>

    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <img src="" alt="" id="popupImage">
            <div id="popupDetails">
                <h2 id="popupTitle"></h2>
                <button onclick="addToCart()" id="orderBtn">Order Now</button>
            </div>
        </div>
    </div>

    <script>
        var allproducts = [];

        $(document).ready(function() {
            $.ajax({
                url: 'fetch_category.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (Array.isArray(data)) {
                        allcategory = data;
                        displayproduct(allcategory);
                    } else {
                        console.error('Expected array but got:', data);
                    }
                },
                error: function() {
                    alert('Failed to fetch product data');
                }
            });
        });

        function displaycategory(category) {
            $('#categoryContainer').empty();
            category.forEach(function(category) {
                var starRating = generateStarRating(category.rating);
                var categoryBox = `
                    <div class='prcategoryoduct-box' data-category='${category.category_name}' data-id='${category.category_id}'>
                        <img src='images2/${category.image}' alt='${category.category_name}'>
                        <div class='overlay'><i class='fas fa-hdd'></i></div>
                        <div class='category-details'>
                            <p>${category.category_name}</p>
                            <p>${category.model}</p>
                            <p class='price'>RS ${part.price}</p>
                            <div class='rating'>
                                ${starRating}
                            </div>
                        </div>
                        <div class='icon-box'>
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-search" onclick='showPopup(${part.part_id})'></i>
                            <i class="fas fa-cart-shopping" onclick='redirectToCart("${part.part_name}")'></i>
                        </div>
                    </div>
                `;
                $('#partsContainer').append(partBox);
            });
        }

        function generateStarRating(rating) {
            var stars = '';
            var fullStars = Math.floor(rating);
            var halfStar = rating - fullStars >= 0.5;

            for (var i = 0; i < fullStars; i++) {
                stars += '<i class="fas fa-star"></i>';
            }
            if (halfStar) {
                stars += '<i class="fas fa-star-half-alt"></i>';
            }
            return stars;
        }

        function filterParts(category) {
            if (category === 'all') {
                displayParts(allParts);
            } else {
                $.ajax({
                    url: 'fetch_parts.php',
                    method: 'GET',
                    data: { part_name: category },
                    dataType: 'json',
                    success: function(data) {
                        displayParts(data);
                    },
                    error: function() {
                        alert('Failed to fetch filtered parts data');
                    }
                });
            }
        }

        function redirectToCart(partName) {
            window.location.href = 'cart.php?part=' + encodeURIComponent(partName);
        }

        function addToCart(partName) {
            alert('Added ' + partName + ' to cart!');
        }

        function showPopup(partId) {
            var part = allParts.find(p => p.part_id === partId);
            if (part) {
                $('#popupTitle').text(part.part_name);
                $('#popupImage').attr('src', 'images2/' + part.image);
                var popupDetails = `
                    <p><strong>Model:</strong> ${part.model}</p>
                    <p><strong>Price:</strong> RS ${part.price}</p>
                    <p><strong>Warranty:</strong> ${part.warranty}</p>
                    <p><strong>Discount:</strong> ${part.discount}%</p>
                    <p><strong>Capacity:</strong> ${part.capacity}</p>
                    <p><strong>Type:</strong> ${part.type}</p>
                    <button onclick='redirectToCart("${part.part_name}")'>Add to Cart <i class="fas fa-cart-shopping"></i></button>
                `;
                $('#popupDetails').html(popupDetails);
                $('#popup').css('display', 'flex');
            } else {
                alert('Part details not found!');
            }
        }

        function closePopup() {
            $('#popup').hide();
        }
    </script>
</body>
</html>
